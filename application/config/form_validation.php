<?php
$config = array(
    // Admin
    'Login' => array(
        array(
            'field' => 'role_id',
            'label' => 'Role ID',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim'
        )
    ),
	'Members' => array(
        array(
            'field' => 'name',
            'label' => 'Member Name',
            'rules' => 'required|trim'
        )
    ),
    'ForgotPassword' => array(
        array(
            'field' => 'role_id',
            'label' => 'Role ID',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile No',
            'rules' => 'required|trim'
        )
    ),
    'ChangePassword' => array(
        array(
            'field' => 'opass',
            'label' => 'Current Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'npass',
            'label' => 'New Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'cpass',
            'label' => 'Confirm Password',
            'rules' => 'required'
        )
    ),

    'userLogin' => array(
        array(
            'field' => 'mobile',
            'label' => 'Mobile No',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim'
        )
    ),
    'ForgotPassword' => array(
        array(
            'field' => 'mobile',
            'label' => 'Mobile No',
            'rules' => 'required|trim'
        )
    ),
    'ForgotOTPVerification' => array(
        array(
            'field' => 'mobile',
            'label' => 'Mobile No',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'otp',
            'label' => 'OTP',
            'rules' => 'required|trim'
        )
    ),
    'ResetPassword' => array(
        array(
            'field' => 'mobile',
            'label' => 'Mobile No',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'npass',
            'label' => 'New Password',
            'rules' => 'required|trim|min_length[6]'
        ),
        array(
            'field' => 'cpass',
            'label' => 'Confirm Password',
            'rules' => 'required|trim|min_length[6]'
        )
    ),
    'Logout' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required|trim'
        )
    ),

    'Category' => array(
        array(
            'field' => 'name',
            'label' => 'Category Name',
            'rules' => 'required|trim'
        )
    ),

    'Subcategory' => array(
        array(
            'field' => 'category_id',
            'label' => 'Category',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'name',
            'label' => 'Subcategory Name',
            'rules' => 'required|trim'
        )
    ),

    //////////////////////////////// APIs //////////////////////////////////
    'Registration' => array(
        array(
            'field' => 'email',
            'label' => 'Email Address',
            'rules' => 'required|trim|valid_email'
        )
    ),


    'MobilePassword' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),
    'OTPVerification' => array(
        array(
            'field' => 'otp',
            'label' => 'OTP',
            'rules' => 'required|trim|min_length[4]|max_length[4]'
        ),
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required'
        )
    ),


    'Profile' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required'
        )
    ),

    'Interests' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required'
        )
    ),

    'Feed' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required|trim'
        )
    ),



    'CompleteProfile' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required'
        ),
        array(
            'field' => 'name',
            'label' => 'Full Name',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'dob',
            'label' => 'DOB',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'language',
            'label' => 'Language',
            'rules' => 'required|trim'
        ), array(
            'field' => 'latitude',
            'label' => 'Latitude',
            'rules' => 'required|trim'
        ), array(
            'field' => 'logitude',
            'label' => 'Longitude',
            'rules' => 'required|trim'
        ), array(
            'field' => 'Address',
            'label' => 'Address',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'about',
            'label' => 'About',
            'rules' => 'required|trim'
        )
    ),


    'UserLogin' => array(
        array(
            'field' => 'email',
            'label' => 'Email Address',
            'rules' => 'required|trim|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim'
        )
    ),

    'UserForgotPassword' => array(
        array(
            'field' => 'email',
            'label' => 'Email Address',
            'rules' => 'required|trim|valid_email'
        )
    ),

    'UserResetPassword' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim|min_length[6]'
        ),
    ),

    'UserChangePassword' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'opass',
            'label' => 'Current Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'npass',
            'label' => 'New Password',
            'rules' => 'required'
        ),
    ),

    'SendRequest' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'member_id',
            'label' => 'Member ID',
            'rules' => 'required'
        )
    ),

    'MyMatches' => array(
        array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'required|trim'
        )
    ),
);
