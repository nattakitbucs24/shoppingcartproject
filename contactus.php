<?php
include 'config.php';

$name = '';
$phone = '';
$email = '';

if (isset($_POST['txtUserFirstName'])) {

	if (isset($_POST['captcha']) && md5($_POST['captcha']) == $_SESSION['captchaKey']) {

		$title  = htmlspecialchars(trim($_POST['txtTitle']));
		$name   = htmlspecialchars(trim($_POST['txtUserFirstName']));
		$phone  = htmlspecialchars(trim($_POST['txtUserPhone']));
		$email  = filter_var(trim($_POST['txtUserEmail']), FILTER_VALIDATE_EMAIL);
		$data   = htmlspecialchars(trim($_POST['txtData']));

		if (!$email) {
			$_SESSION['plaincart_error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
		} else {

			$shopEmail  = "test@example.com"; // 🔥 เปลี่ยนเป็นเมลจริงถ้าใช้โฮสต์จริง

			$subject = 'ข้อคิดเห็น เรื่อง - ' . $title;

			$message = "
                <h3>ข้อคิดเห็นจากลูกค้า</h3>
                <p><strong>ชื่อ:</strong> $name</p>
                <p><strong>เบอร์โทร:</strong> $phone</p>
                <p><strong>อีเมล:</strong> $email</p>
                <hr>
                <p><strong>ข้อความ:</strong></p>
                <p>$data</p>
            ";

			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8\r\n";
			$headers .= "From: <$email>\r\n";
			$headers .= "Reply-To: $email\r\n";

			if (mail($shopEmail, $subject, $message, $headers)) {
				$_SESSION['plaincart_success'] = 'ส่งข้อความเรียบร้อยแล้ว';
			} else {
				$_SESSION['plaincart_error'] = 'ไม่สามารถส่งอีเมลได้ (XAMPP จะไม่ส่งจริง)';
			}
		}
	} else {
		$_SESSION['plaincart_error'] = 'คุณกรอกรหัส Captcha ไม่ถูกต้อง';
	}
}
require_once 'include/header.php';
?>

<div class="panel panel-info">
  <div class="panel-heading">ติดต่อเรา</div>
  <div class="panel-body">

    <?php
		if (isset($_SESSION['plaincart_error'])) {
			echo '<div class="alert alert-danger">' . $_SESSION['plaincart_error'] . '</div>';
			unset($_SESSION['plaincart_error']);
		}
		if (isset($_SESSION['plaincart_success'])) {
			echo '<div class="alert alert-success">' . $_SESSION['plaincart_success'] . '</div>';
			unset($_SESSION['plaincart_success']);
		}
		?>

    <form method="post">

      <table class="table table-bordered">

        <tr>
          <td>เรื่อง</td>
          <td><input type="text" name="txtTitle" class="form-control" required></td>
        </tr>

        <tr>
          <td>ชื่อ</td>
          <td><input type="text" name="txtUserFirstName" class="form-control" required></td>
        </tr>

        <tr>
          <td>โทรศัพท์</td>
          <td><input type="text" name="txtUserPhone" class="form-control"></td>
        </tr>

        <tr>
          <td>อีเมล</td>
          <td><input type="email" name="txtUserEmail" class="form-control" required></td>
        </tr>

        <tr>
          <td>ข้อความ</td>
          <td><textarea name="txtData" class="form-control" rows="5" required></textarea></td>
        </tr>

        <tr>
          <td>Captcha</td>
          <td>
            <img src="include/captcha/captcha.php">
            <input type="text" name="captcha" class="form-control" required>
          </td>
        </tr>

      </table>

      <div style="text-align:center;">
        <input type="submit" value="ส่ง" class="btn btn-primary">
      </div>

    </form>

  </div>
</div>

<?php require_once 'include/footer.php'; ?>