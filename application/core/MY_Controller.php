<?php
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("asia/kolkata");

        $this->data = (object) [
            // 'appName' => 'PCF - SOCIETY',
            // 'appName' => 'PCF Employees Cooperative Society Ltd.',
            'appName' => 'PCF EMPL.Coop.Society Ltd.32,Station Road Lucknow.',
            'appLink' => base_url(),
            'appEmail' => 'info@PCF.com',
            'appMobileNo' => '0000000000',
            'appAddress' => '22-23, Behind State Bank of India Babuganj Branch, Near IT Chauraha, Lucknow, UP, India, 226007',
            'copyrightName' => 'PCF - Student Report',
            'copyrightLink' => 'https://digicoders.in/',
            'controller' => $this->router->fetch_class(),
            'method' => $this->router->fetch_method(),
            'appTempletePath' => 'assets/application/',
            'webPath' => 'assets/website/',
            'timestamp' => date('Y-m-d H:i:s'),
            'date' => date("Y/m/d"),
            'time' => date("h:i:s A"),
            'day' => date("l"),
            'otp' => '1234', //rand(1000,9999),
            'password' => '123456789', //time(),
        ];
    }
}
class Auth_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data->role_id = '0';
        $this->data->title = 'Authentication';
        $this->data->pageTitle = preg_replace('/(?<!\ )[A-Z]/', ' $0', $this->data->method);
        $this->data->subTitle = $this->data->pageTitle;
    }
}
class Admin_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data->role_id = '1';
        $this->data->title = 'Admin';
        $this->data->pageTitle = preg_replace('/(?<!\ )[A-Z]/', ' $0', $this->data->method);
        $this->data->subTitle = $this->data->pageTitle;
        $this->data->permission = ['ManageSchools', 'ManageTeachers', 'ManageStudents', 'ManageCourses', 'ManageCourseMaterial', 'ManageCoursesActivities', 'ManageQuiz', 'RecommendedVideos', 'HelpAndSupport', 'ChatForum', 'DownloadableResources', 'ManagePackages', 'ManageSchoolPackages', 'PaymentsAndTransactions', 'ManageWebsiteContents', 'AccessAnyPanel'];
    }
}

class Web_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data->controller = 'Website';
        $this->data->role_id = '2';
        $this->data->title = 'Frenfy';
        $this->data->subTitle = $this->data->method;
        $this->data->pageTitle = preg_replace('/(?<!\ )[A-Z]/', ' $0', $this->data->subTitle);
        $this->webData = (object) [
            'facebookLink' => '',
            'twitterLink' => '',
            'instagramLink' => '',
            'linkedinLink' => '',
            'address' => 'IT Chauraha, Lucknow',
            'phoneNo' => '0000000000',
            'emailAddress' => 'codliv@gmail.com',
        ];
        $this->data = (object) array_merge((array) $this->data, (array) $this->webData);
    }
}
class Api_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data->role_id = '2';
        $this->data->title = 'User';
        $this->data->pageTitle = preg_replace('/(?<!\ )[A-Z]/', ' $0', $this->data->method);
        $this->data->subTitle = $this->data->pageTitle;
    }
}
