<?php


namespace app\controllers;


use app\models\LoginForm;
use app\models\SingupForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
    	$model = new SingupForm();

	    if(Yii::$app->request->isPost)
	    {
		    $model->load(Yii::$app->request->post());
		    if($model->signup())
		    {
			    return $this->redirect(['auth/login']);
		    }
	    }

    	return $this->render('signup', ['model' => $model]);
    }

    public function actionTest()
    {
        if (Yii::$app->user->isGuest) {
        	echo "Guest";
        } else {
        	print_r(Yii::$app->user);
        	echo "Real User D";
        }
    }
}