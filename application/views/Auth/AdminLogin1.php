<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php require 'CssLinks.php'; ?>
</head>

<body class="crm_body_bg">


    <section class="main_content dashboard_part large_header_bg">

        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">

                    <div class="col-lg-12">
                        <div class="white_box mb_30">
                            <div class="row justify-content-center" id="box-admin">
                                <div class="col-lg-5">

                                    <div class="modal-content cs_modal">
                                        <div class="modal-header justify-content-center theme_bg_1">
                                            <h5 class="modal-title text_white">Admin Login</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="<?= base_url($this->data->controller . '/Authentication/Login'); ?>" id="addForm">
                                                <input type="hidden" name="role_id" value="<?= $this->data->role_id; ?>" />
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

                                                <label for="username">Username <span class="text-danger">*</span></label>
                                                <div class="">
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Email Address">
                                                    <?php echo form_error("username", "<p class='text-danger' >", "</p>"); ?>
                                                </div>
                                                <div class="">
                                                    <label for="password">Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control password" id="password" name="password" placeholder="Password">
                                                    <?php echo form_error("password", "<p class='text-danger'>", "</p>"); ?>
                                                </div>

                                                <button type="submit" class="btn_1 full_width text-center" id="addBtn"><i class="feather icon-unlock"></i> Login <i class="fa fa-spinner fa-spin" id="addSpin" style="display:none;"></i></button>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require 'Footer.php'; ?>
    </section>

    <?php require 'JsLinks.php'; ?>
</body>

</html>