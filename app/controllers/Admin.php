<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Router;
use Core\Helpers;
use Core\Session;
use Core\Controller;
use App\models\Image;
use App\models\Users;
use App\models\Articles;
use App\models\Comments;
use App\models\Categories;
use App\models\Permission;
use Core\helpers\FileUpload;
use App\models\Advertisements;
use App\models\CommentReplies;
use App\models\Settings;
use App\models\Tickers;

defined('ROOT_PATH') or exit('Access Denied!');

class Admin extends Controller
{
    public $currentUser;

    public function onConstruct()
    {
        Permission::permRedirect(['admin', 'manager', 'author'], '');
        $this->view->setLayout('admin');
        $this->currentUser = Users::getCurrentUser();
    }

    public function index()
    {
        Router::redirect('admin/dashboard');
    }

    public function dashboard()
    {
        $view = [
        ];
        $this->view->render('admin/dashboard', $view);
    }

    /** ****** User Actions ******* */

    public function users()
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = ['order' => 'fname, lname'];
        $params = Users::mergeWithPagination($params);

        $view = [
            'users' => Users::find($params),
            'total' => Users::findTotal($params),
        ];
        $this->view->render('admin/users/users', $view);
    }

    public function user($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        if ($id == 'new') {
            $user = new Users();
        } else {
            $params = [
                'conditions' => "uid = :uid",
                'bind' => ['uid' => $id]
            ];
            $user = Users::findFirst($params);
        }

        if (!$user) {
            Session::msg("You do not have permission to edit this user");
            Router::redirect('admin/dashboard');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $fields = ['fname', 'lname', 'email', 'phone', 'acl', 'password', 'confirm_password'];
            foreach ($fields as $field) {
                $user->{$field} = esc($this->request->getReqBody($field));
            }
            $user->username = "@" . $user->fname . '_' . $user->lname;

            if ($id != 'new' && !empty($user->password)) {
                $user->resetPassword = false;
            }

            if ($user->save()) {
                Session::msg("Account Created Successfully!. Send details to user via Mail.", "success");
                Router::redirect('admin/users');
            }
        }

        $view = [
            'header' => $id == 'new' ? 'Create New User' : 'Edit User',
            'errors' => $user->getErrors(),
            'user' => $user,
            'acl_opts' => [
                '' => '',
                Users::AUTHOR_PERMISSION => 'Author',
                Users::MANAGER_PERMISSION => 'Manager',
                Users::ADMIN_PERMISSION => 'Admin',
            ]
        ];
        $this->view->render('admin/users/user', $view);
    }

    /**
     * Summary of toggleUserAction
     * Toggle User Blocked status. 0 or 1.
     * @param mixed $userId
     */
    public function toggleUser($userId)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = [
            'conditions' => "uid = :uid",
            'bind' => ['uid' => $userId]
        ];
        $user = Users::findFirst($params);
        $msg = 'User cannot be blocked';
        $type = "danger";
        if ($user && $user->uid !== $this->currentUser->uid) {
            $user->blocked = $user->blocked ? 0 : 1;
            $user->save();
            $msg = $user->blocked ? "User blocked." : "User unblocked.";
            $type = "success";
        }
        Session::msg($msg, $type);
        Router::redirect('admin/users');
    }

    /**
     * Summary of deleteUserAction
     * Delete User from the Database.
     * @param mixed $userId
     */
    public function deleteUser($userId)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');
        $params = [
            'conditions' => "uid = :uid",
            'bind' => ['uid' => $userId]
        ];
        $user = Users::findFirst($params);
        $msgType = 'danger';
        $msg = 'User cannot be deleted';
        if ($user && $user->uid !== $this->currentUser->uid) {
            $user->delete();
            $msgType = 'success';
            $msg = 'User deleted';
        }
        Session::msg($msg, $msgType);
        Router::redirect('admin/users');
    }

    /** ******* Articles Actions ******** */

    public function articles()
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        if ($this->currentUser->acl === 'admin' || $this->currentUser->acl === 'manager') {
            $params = [
                'columns' => "articles.*, users.username",
                'joins' => [
                    ['users', 'articles.user_id = users.uid'],
                ],
                'order' => 'articles.id DESC'
            ];
        } else {
            $params = [
                'columns' => "articles.*, users.username",
                'joins' => [
                    ['users', 'articles.user_id = users.uid'],
                ],
                'conditions' => "user_id = :user_id",
                'bind' => ['user_id' => $this->currentUser->uid],
                'order' => 'articles.id DESC'
            ];
        }

        $params = Articles::mergeWithPagination($params);

        $view = [
            'articles' => Articles::find($params),
            'total' => Articles::findTotal($params),
        ];
        $this->view->render('admin/articles/articles', $view);
    }

    public function article($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        $params = [
            'conditions' => "id = :id AND user_id = :user_id",
            'bind' => ['id' => $id, 'user_id' => $this->currentUser->uid]
        ];
        $article = $id == 'new' ? new Articles() : Articles::findFirst($params);
        if (!$article) {
            Session::msg("You do not have permission to edit this article");
            Router::redirect('admin/articles');
        }

        $categories = Categories::find(['order' => 'category']);
        $catOptions = [0 => ''];
        foreach ($categories as $category) {
            $catOptions[$category->id] = $category->category;
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $article->user_id = $this->currentUser->uid;
            $article->title = esc($this->request->getReqBody('title'));
            $article->status = $this->request->getReqBody('status');
            $article->content = $this->request->getReqBody('content');
            $article->category_id = $this->request->getReqBody('category_id');
            $article->trending = $this->request->getReqBody('trending');
            $article->tags = esc($this->request->getReqBody('tags'));
            $article->meta_description = esc($this->request->getReqBody('meta_description'));
            $article->meta_keywords = esc($this->request->getReqBody('meta_keywords'));
            /** Image Upload validation and Upload */
            $upload = new FileUpload('thumbnail');
            if ($id == 'new') {
                $upload->required = true;
            }

            $uploadErrors = $upload->validate();

            if (!empty($uploadErrors)) {
                foreach ($uploadErrors as $field => $error) {
                    $article->setError($field, $error);
                }
            }

            /** Set end one Image Upload validation and Upload */

            if (empty($article->getErrors())) {
                $upload->directory('uploads/articles');

                if ($article->save()) {
                    if (!empty($upload->tmp)) {

                        if ($upload->upload()) {
                            if ($id != 'new' && file_exists($article->thumbnail)) {
                                unlink($article->thumbnail);
                                $article->thumbnail = "";
                            }
                            $article->thumbnail = $upload->fc;
                            $image = new Image();
                            $image->resize($article->thumbnail);
                            $article->save();
                        }
                    }
                    Session::msg("{$article->title} saved.", 'success');
                    Router::redirect('admin/articles');
                }
            }

        }

        $view = [
            'errors' => $article->getErrors(),
            'article' => $article,
            'hasImage' => !empty($article->img),
            'statusOptions' => ['' => '', 'draft' => 'Draft', 'published' => 'Published'],
            'trendingOptions' => [0 => 'No', 1 => 'Yes'],
            'categoryOptions' => $catOptions,
            'heading' => $id === 'new' ? "Add New Article" : "Edit Article"
        ];
        $this->view->render('admin/articles/article', $view);
    }

    public function deleteArticle($id)
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        if ($this->currentUser->acl === 'admin' || $this->currentUser->acl === 'manager') {
            $params = [
                'conditions' => "id = :id",
                'bind' => ['id' => $id]
            ];
        } else {
            $params = [
                'conditions' => "id = :id AND user_id = :user_id",
                'bind' => ['id' => $id, 'user_id' => $this->currentUser->uid]
            ];
        }

        $article = Articles::findFirst($params);
        if ($article) {
            Session::msg("Article Deleted.", 'success');
            if (!empty($article->thumbnail) && file_exists($article->thumbnail)) {
                unlink($article->thumbnail);
            }
            $article->delete();
        } else {
            Session::msg("You do not have permission to delete that article");
        }
        Router::redirect('admin/articles');
    }

    public function review($id)
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        $params = [
            'columns' => "articles.*, users.username, users.fname, users.lname, users.img",
            'conditions' => "slug = :slug AND status = :status",
            'bind' => ['status' => 'published', 'slug' => $id],
            'joins' => [
                ['users', 'articles.user_id = users.uid'],
            ],
            'order' => 'id DESC'
        ];

        $article = Articles::findFirst($params);
        if (!$article)
            Router::redirect('_404');

        $view = [
            'article' => $article,
        ];
        $this->view->render('admin/articles/review', $view);
    }

    /** ******* Categories Actions ******** */
    public function categories()
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = ['order' => 'category'];
        $params = Categories::mergeWithPagination($params);

        $view = [
            'categories' => Categories::find($params),
            'total' => Categories::findTotal($params),
        ];
        $this->view->render('admin/categories/categories', $view);
    }

    public function category($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $category = $id == 'new' ? new Categories() : Categories::findById($id);

        if (!$category) {
            Session::msg("Category does not exist.");
            Router::redirect('admin/categories');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $category->category = esc($this->request->getReqBody('category'));
            $category->status = $this->request->getReqBody('status');

            if ($category->save()) {
                Session::msg('Category Saved!', 'success');
                Router::redirect('admin/categories');
            }
        }

        $view = [
            'errors' => $category->getErrors(),
            'category' => $category,
            'header' => $id == 'new' ? "Add Category" : "Edit Category",
            'category_status_opts' => [
                '' => '',
                Categories::ACTIVE_STATUS => "Active",
                Categories::DISABLED_STATUS => "Disabled",
            ]
        ];
        $this->view->render('admin/categories/category', $view);
    }

    public function deleteCategory($id)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');
        $category = Categories::findById($id);
        if (!$category) {
            Session::msg("That category does not exist");
            Router::redirect('admin/categories');
        } else {
            $category->delete();
            Session::msg("Category Deleted.", 'success');
            Router::redirect('admin/categories');
        }
    }

    /** ******* Comments Actions ********* */
    public function comments($id = '')
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        if ($id === '') {
            Session::msg("Comment Parameters is needed, can't be empty.", 'danger');
            Router::lastURL();
        }

        $params = [
            'columns' => "comments.*, users.username, articles.user_id as uid",
            'conditions' => "comments.article_slug = :article_slug AND comments.status = :status AND articles.user_id = :user_id",
            'bind' => ['article_slug' => $id, 'status' => 'active', 'user_id' => $this->currentUser->uid],
            'joins' => [
                ['users', 'comments.user_id = users.uid'],
                ['articles', 'comments.article_slug = articles.slug', 'articles', 'LEFT']
            ],
            'order' => 'comments.created_at DESC'
        ];

        $comments = Comments::find($params);

        if (empty($comments)) {
            Session::msg("No comment available yet! Or you can't view this Article comments.", 'info');
            Router::lastURL();
        }

        $view = [
            'comments' => $comments,
            'total' => Comments::findTotal($params),
        ];
        $this->view->render('admin/comments/comments', $view);
    }

    public function viewCommentReplies()
    {
        if (isset($_POST['view_comment_data'])) {
            $comment_id = esc($this->request->getReqBody('comment_id'));

            $params = [
                'columns' => "comment_replies.*, users.username",
                'conditions' => "comment_replies.comment_id = :comment_id AND comment_replies.status = :status",
                'bind' => ['comment_id' => $comment_id, 'status' => 'active'],
                'joins' => [
                    ['users', 'comment_replies.user_id = users.uid'],
                ],
                'order' => 'comment_replies.created_at DESC'
            ];

            $commentReplies = CommentReplies::find($params);

            if ($commentReplies) {
                $this->jsonResponse($commentReplies);
            } else {
                $this->jsonResponse("No comment replies yet.");
            }
        }
    }

    public function commentDelete($id)
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');
        $comment = Comments::findById($id);
        if (!$comment) {
            Session::msg("That comment does not exist");
            Router::lastURL();
        }

        if ($comment->delete()) {
            $params = [
                'conditions' => "comment_id = :comment_id",
                'bind' => ['comment_id' => $id]
            ];
            $commentReplies = CommentReplies::find($params);
            foreach ($commentReplies as $replies) {
                $replies->delete();
            }
            Session::msg("Comment Deleted.", 'success');
            Router::lastURL();
        }
    }

    public function commentReplyDelete($id)
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        $commentReply = CommentReplies::findById($id);
        if (!$commentReply) {
            Session::msg("That comment does not exist");
            Router::lastURL();
        } else {
            $commentReply->delete();
            Session::msg("Comment Deleted.", 'success');
            Router::lastURL();
        }
    }

    /** ********* Advertisement Actions ********* */
    public function advertisements()
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = ['order' => 'company'];
        $params = Advertisements::mergeWithPagination($params);

        $view = [
            'advertisements' => Advertisements::find($params),
            'total' => Advertisements::findTotal($params)
        ];
        $this->view->render('admin/advertisements/advertisements', $view);
    }

    public function advertisement($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $advertisement = $id == 'new' ? new Advertisements() : Advertisements::findById($id);

        if (!$advertisement) {
            Session::msg("Advertisement does not exist.");
            Router::redirect('admin/advertisements');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $advertisement->company = esc($this->request->getReqBody('company'));
            $advertisement->position = esc($this->request->getReqBody('position'));
            $advertisement->bgcolor = esc($this->request->getReqBody('bgcolor'));
            $advertisement->status = esc($this->request->getReqBody('status'));
            $advertisement->objfit = esc($this->request->getReqBody('objfit'));
            $advertisement->link = esc($this->request->getReqBody('link'));

            /** Image Upload validation and Upload */
            $upload = new FileUpload('img');
            if ($id == 'new') {
                $upload->required = true;
            }

            $uploadErrors = $upload->validate();

            if (!empty($uploadErrors)) {
                foreach ($uploadErrors as $field => $error) {
                    $advertisement->setError($field, $error);
                }
            }

            if (empty($advertisement->getErrors())) {
                $upload->directory('uploads/advertisements');

                if ($advertisement->save()) {
                    if (!empty($upload->tmp)) {

                        if ($upload->upload()) {
                            if ($id != 'new' && file_exists($advertisement->img)) {
                                unlink($advertisement->img);
                                $advertisement->img = "";
                            }
                            $advertisement->img = $upload->fc;
                            $image = new Image();
                            $image->resize($advertisement->img);
                            $advertisement->save();
                        }
                    }
                    Session::msg("{$advertisement->company} Advertisement Saved.", 'success');
                    Router::redirect('admin/advertisements');
                }
            }
        }

        $view = [
            'errors' => $advertisement->getErrors(),
            'advertisement' => $advertisement,
            'header' => $id == 'new' ? "Add Advertisement" : "Edit Advertisement",
            'statusOpts' => ['' => '', 'disabled' => 'Disabled', 'active' => 'Active'],
            'positionOpts' => ['' => '', 'main' => 'Main', 'partial' => 'Partial'],
            'objOpts' => ['' => '', 'none' => 'None', 'fill' => 'Fill', 'cover' => 'Cover', 'contain' => 'Contain']
        ];
        $this->view->render('admin/advertisements/advertisement', $view);
    }

    public function deleteAdvertisement($id)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = [
            'conditions' => "id = :id",
            'bind' => ['id' => $id]
        ];

        $advertisement = Advertisements::findFirst($params);
        if ($advertisement) {
            Session::msg("Advertisement Deleted.", 'success');
            if (!empty($advertisement->img) && file_exists($advertisement->img)) {
                unlink($advertisement->img);
            }
            $advertisement->delete();
        } else {
            Session::msg("You do not have permission to delete that advertisement");
        }
        Router::redirect('admin/advertisements');
    }

    /** ********* Tickers Actions ********* */

    public function tickers()
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = ['order' => 'id DESC'];
        $params = Tickers::mergeWithPagination($params);

        $view = [
            'tickers' => Tickers::find($params),
            'total' => Tickers::findTotal($params)
        ];
        $this->view->render('admin/tickers/tickers', $view);
    }

    public function ticker($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $ticker = $id == 'new' ? new Tickers() : Tickers::findById($id);

        if (!$ticker) {
            Session::msg("Ticker does not exist.");
            Router::redirect('admin/tickers');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $ticker->content = esc($this->request->getReqBody('content'));
            $ticker->status = esc($this->request->getReqBody('status'));

            if ($ticker->save()) {
                Session::msg('Ticker Saved!', 'success');
                Router::redirect('admin/tickers');
            }
        }

        $view = [
            'errors' => [],
            'ticker' => $ticker,
            'header' => $id == 'new' ? "Add Ticker" : "Edit Ticker",
            'ticker_status_opts' => ['' => '', 'disabled' => 'Disabled', 'active' => 'Active'],
        ];
        $this->view->render('admin/tickers/ticker', $view);
    }

    public function deleteTicker($id)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $ticker = Tickers::findById($id);
        if (!$ticker) {
            Session::msg("That ticker does not exist");
            Router::redirect('admin/tickers');
        }

        if ($ticker->delete()) {
            Session::msg("Ticker Deleted.", 'success');
            Router::redirect('admin/tickers');
        }
    }

    /** ******** Settings Actions ********* */

    public function settings()
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = ['order' => 'id DESC'];
        $params = Settings::mergeWithPagination($params);

        $view = [
            'settings' => Settings::find($params),
            'total' => Settings::findTotal($params),
        ];
        $this->view->render('admin/settings/settings', $view);
    }

    public function setting($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $setting = $id == 'new' ? new Settings() : Settings::findById($id);

        if (!$setting) {
            Session::msg("Setting does not exist.");
            Router::redirect('admin/settings');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $setting->setting = esc($this->request->getReqBody('setting'));
            $setting->status = esc($this->request->getReqBody('status'));
            $setting->type = esc($this->request->getReqBody('type'));

            if ($id !== 'new' && $setting->type !== 'image') {
                $setting->value = esc($this->request->getReqBody('value'));
            }

            if ($id !== 'new' && $setting->type === 'image') {
                $upload = new FileUpload('value');

                $uploadErrors = $upload->validate();

                if (!empty($uploadErrors)) {
                    foreach ($uploadErrors as $field => $error) {
                        $setting->setError($field, $error);
                    }
                }

                if (empty($setting->getErrors())) {
                    $upload->directory('uploads/settings');

                    if ($setting->save()) {
                        if (!empty($upload->tmp)) {

                            if ($upload->upload()) {
                                if (!is_null($setting->value)) {
                                    if ($id != 'new' && file_exists($setting->value)) {
                                        unlink($setting->value);
                                        $setting->value = "";
                                    }
                                }
                                $setting->value = $upload->fc;
                                $image = new Image();
                                $image->resize($setting->value);
                                $setting->save();
                            }
                        }
                        Session::msg("Setting: {$setting->setting} saved.", 'success');
                        Router::redirect('admin/settings');
                    }
                }
            }

            if ($setting->save()) {
                Session::msg("Setting {$setting->setting} Saved!", 'success');
                Router::redirect('admin/settings');
            }

        }

        $view = [
            'errors' => $setting->getErrors(),
            'header' => $id == 'new' ? "Add Setting" : "Edit Setting",
            'typeOpts' => ['' => '', 'text' => 'Text', 'image' => 'Image', 'link' => 'Link'],
            'statusOpts' => ['' => '', Settings::ACTIVE_STATUS => 'Active', Settings::DISABLED_STATUS => 'Disabled'],
            'setting' => $setting,
        ];
        $this->view->render('admin/settings/setting', $view);
    }

    public function deleteSetting($id)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = [
            'conditions' => "id = :id",
            'bind' => ['id' => $id]
        ];

        $setting = Settings::findFirst($params);

        if ($setting) {
            if ($setting->type === 'image') {
                if (!empty($setting->value) && file_exists($setting->value)) {
                    unlink($setting->value);
                }
            }
            $setting->delete();
        }
        Session::msg("Setting Deleted Successfully!", "success");
        Router::redirect('admin/settings');
    }
}