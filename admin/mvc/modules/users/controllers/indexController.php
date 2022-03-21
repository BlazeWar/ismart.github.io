<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function regAction()
{
    global $error, $username, $password, $email, $fullname;
    // echo send_mail('nguyentruongtue1996@gmail.com', "Nguyễn Trường Tuệ", 'Kích hoạt tài khoản', "LINK");
    if (isset($_POST['btn-reg'])) {
        $error = array(); //Phất cờ
        # Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            //Hạ cờ
            $error['fullname'] = "Không được để trống trường fullname";
        } else {
            $fullname = $_POST['fullname'];
        }
        # Kiểm tra username
        if (empty($_POST['username'])) {
            //Hạ cờ
            $error['username'] = "Không được để trống trường Username";
        } else {
            if (!(strlen($_POST['username']) >= 6 && strlen($_POST['username']) <= 32)) {
                $error['username'] = "Username yêu cầu từ 6 đến 32 ký tự";
            } else {

                if (!is_username($_POST['username']))
                    $error['username'] = "Username bạn vừa nhập không đúng định dạng";
                else {
                    $username = $_POST['username'];
                }
            }
        }
        # Kiểm tra password
        if (empty($_POST['password'])) {
            //Hạ cờ
            $error['password'] = "Không được để trống trường Password";
        } else {

            if (!is_password($_POST['password']))
                $error['password'] = "Password bạn vừa nhập không đúng định dạng";
            else {
                $password = md5($_POST['password']);
            }
        }

        # Kiểm tra email
        if (empty($_POST['email'])) {
            //Hạ cờ
            $error['email'] = "Không được để trống trường Email";
        } else {

            if (!is_email($_POST['email']))
                $error['email'] = "Email bạn vừa nhập không đúng định dạng";
            else {
                $email = $_POST['email'];
            }
        }

        //Kết luận
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'active_token' => $active_token,
                    'reg_date' => time(),
                    // 'gender' => $gender,
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$username}</p>
                            <p>Bạn vui lòng click vào đường link để kích hoạt tài khoản: {$link_active}</p>
                            <p>Nếu ko phải bạn đăng ký thì bỏ qua email này</p>";
                send_mail($email, $fullname, 'Kích hoạt tài khoản', $content);

                //Thông báo
                redirect("?mod=users&action=login");
            } else {
                $error["account"] = "Username hoặc email đã tồn tại trên hệ thống";
            }
        }
    }
    load_view('reg');
}

function loginAction()
{
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = array();
        #Kiểm tra username
        if (empty($_POST['username'])) {
            //Hạ cờ
            $error['username'] = "Không được để trống trường Username";
        } else {
            if (!(strlen($_POST['username']) >= 6 && strlen($_POST['username']) <= 32)) {
                $error['username'] = "Username yêu cầu từ 6 đến 32 ký tự";
            } else {

                if (!is_username($_POST['username']))
                    $error['username'] = "Username bạn vừa nhập không đúng định dạng";
                else {
                    $username = $_POST['username'];
                }
            }
        }
        # Kiểm tra password
        if (empty($_POST['password'])) {
            //Hạ cờ
            $error['password'] = "Không được để trống trường Password";
        } else {

            if (!is_password($_POST['password']))
                $error['password'] = "Password bạn vừa nhập không đúng định dạng";
            else {
                $password = md5($_POST['password']);
            }
        }
        #Kết luận
        if (empty($error)) {
            // Xử lý login
            if (check_login($username, $password)) {
                // Lưc trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                // Chuyển hướng vào trong hệ thống
                redirect("?mod=home&controller=index");
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không tồn tại";
            }
        };
    }
    load_view('login');
}

function activeAction()
{
    $link_login = base_url("?mod=users&action=login");
    $active_token = $_GET['active_token'];
    if (check_active_token($active_token)) {
        active_user($active_token);

        echo "Bạn đã kích hoạt thành công vui lòng click vào link sau để đăng nhập:<a href='{$link_login}'>Đăng Nhập</a>";
    } else {
        echo "Yêu cầu kích hoạt ko hợp lệ hoặc tài khoản đã được kích hoạt trước đó! Vui lòng click vào link để đăng nhập:<a href='{$link_login}'>Đăng Nhập</a>";
    }
}
function logoutAction()
{
    #Xử lý logout
    unset($_SESSION['is_login']);
    unset($_SESSION['unset_login']);

    redirect('?mod=users&action=login');
}
function resetAction()
{
    global $error;

    if (empty($_GET['reset_token'])) {
        //If not isset -> set with dumy value
        $_GET['reset_token'] = "";
    } else {
        $reset_token = $_GET['reset_token'];
    }
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn-new-pass'])) {
                $error = array();
                # Kiểm tra password
                if (empty($_POST['password'])) {
                    //Hạ cờ
                    $error['password'] = "Không được để trống trường Password";
                } else {

                    if (!is_password($_POST['password']))
                        $error['password'] = "Password bạn vừa nhập không đúng định dạng";
                    else {
                        $password = md5($_POST['password']);
                    }
                }
                if (empty($error)) {
                    $data = array(
                        'password' => $password,
                    );
                    update_pass($data, $reset_token);
                    redirect("?mod=users&action=resetsuccess");
                }
            }
            load_view('newpass');
        } else {
            echo "Yêu lấy lại mật khẩu không hợp lệ";
        }
    } else {
        if (isset($_POST['btn-reset'])) {
            $error = array();
            # Kiểm tra email

            if (empty($_POST['email'])) {
                //Hạ cờ
                $error['email'] = "Không được để trống trường Email";
            } else {

                if (!is_email($_POST['email']))
                    $error['email'] = "Email bạn vừa nhập không đúng định dạng";
                else {
                    $email = $_POST['email'];
                }
            }
            #Kết luận
            if (empty($error)) {

                // Xử lý login
                if (check_email($email)) {

                    $reset_token = md5($email . time());

                    $data = array(
                        'reset_token' => $reset_token,
                    );
                    // Cập nhật reset pass cho user cần khôi phục mật khẩu
                    update_reset_token($data, $email);
                    // Gửi link qua email cho người cần khôi phục mật khẩu
                    $link_reset = base_url("?mod=users&action=reset&reset_token={$reset_token}");
                    $content = "<p>Chào bạn </p>
                                <p>Bạn vui lòng click vào đường link để khôi phục tài khoản: {$link_reset}</p>
                                <p>Nếu ko phải bạn thì bỏ qua email này</p>";
                    send_mail($email, '', 'Khôi phục mật khẩu', $content);
                    redirect("?mod=users&action=ggmail");
                } else {
                    $error['account'] = "Email không tồn tại trên hệ thống";
                }
            };
        }
        load_view('reset');
    }
}
function resetsuccessAction()
{
    load_view('resetsuccess');
}
function ggmailAction()
{
    load_view('ggmail');
}
