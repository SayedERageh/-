<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>celrifcation</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

    <style>
      /* تنسيق الخطوط والخلفية */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Amiri', serif;
}

body {
  background-color: #f0f0f0;
  font-size: 18px;
  color: #333;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  height: 100vh;
}

/* العنصر الرئيسي (mother) */
#mother {
  display: flex;
  justify-content: space-between;
  width: 95%;
  max-width: 1600px; /* زيادة العرض ليشمل المساحة الأكبر */
  margin: 20px;
  gap: 30px; /* زيادة المسافات بين الأعمدة */
}

/* التنسيق لـ aside */
aside {
  width: 100%; /* زيادة العرض ليأخذ مساحة أكبر */
  padding: 20px;
  background-color: #8be2ff;
  border-radius: 8px;
  text-align: center;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

aside img {
  width: 120px; /* زيادة حجم الصورة لتتناسب مع العرض الأكبر */
  margin-bottom: 20px;
}

aside h3 {
  margin-bottom: 15px;
  font-size: 24px;
  font-weight: bold;
}

aside label {
  display: block;
  margin-bottom: 8px;
  font-size: 16px;
}

aside input {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 2px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
}

aside button {
  width: 48%;
  padding: 12px;
  background-color: #28a745;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 4px;
  margin: 10px 0;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

aside button:hover {
  background-color: #218838;
}

aside button.del {
  background-color: #dc3545;
}

aside button.del:hover {
  background-color: #c82333;
}

/* التنسيق للـ main (عرض بيانات الطلاب) */
main {
  width: 60%; /* زيادة العرض ليأخذ مساحة أكبر */
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  overflow-x: auto;
}

main table {
  width: 100%;
  margin-top: 20px;
  border-collapse: collapse;
}

main th, main td {
  padding: 12px;
  text-align: center;
  border: 1px solid #ddd;
}

main th {
  background-color: #f8f8f8;
}

main tr:nth-child(even) {
  background-color: #f9f9f9;
}

main tr:hover {
  background-color: #f1f1f1;
}

/* تحسينات تفاعلية عند التمرير */
main table tr:hover, aside button:hover {
  transform: scale(1.02);
  transition: transform 0.2s ease-in-out;
}

/* تحسينات الاستجابة للأجهزة الصغيرة */
@media (max-width: 768px) {
  #mother {
    flex-direction: column;
    align-items: center;
    width: 100%;
  }

  aside, main {
    width: 90%;
    margin-bottom: 20px;
  }

  aside button {
    width: 100%;
  }
}

    </style>
</head>
<body dir='rtl'>
    <!-- الاتصال مع قاعدة البيانات -->
    <?php
    $conn = mysqli_connect('localhost','root','','student1');
    $res=mysqli_query($conn,"select * from student");
    $id='';
    $name='';
    $address='';
    if(isset($_POST['id'])){
        $id=$_POST['id'];
    }  if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['address'])) {
    $address = $_POST['address'];
}

    $sqls = '';
    if (isset($_POST['add'])) {
        $sqls = "INSERT INTO student VALUES ('$id', '$name', '$address')";
      mysqli_query($conn,$sqls);
      header("location: home.php");

        // تنفيذ الاستعلام هنا
    }
    if (isset($_POST['del'])) {
        $sqls = "DELETE FROM student WHERE name='$name'";
        mysqli_query($conn,$sqls);
        header("location: home.php");}


    

    ?>
    <div id="mother">
        <form action="" method="post">
            <!-- لوحة التحكم -->

            <aside>

                  <div class="div">
                    <img src="logo.webp" alt="لوحوا الموقع">
                    <h3>لوحة المدير</h3>
                    <label for="">رقم الطالب:</label><br>
                    <input type="text" name="id" id="id"><br>
                    <label for="">اسم الطالب:</label><br>
                    <input type="text" name="name" id="name"><br>
                    <label for="">عنوان الطالب:</label><br>
                    <input type="text" name="address" id="address"><br>
                    <button name="add" style="background-color: green;">اضافة طالب</button>
                    <button name="del" style="background: red;">حذف طالب</button>

                  </div>

            </aside>
            
        </form>

        <!-- عرص بيانات الطلاب  -->
         <main>

         <table id="tbl">
            <tr>
                <th>رقم الطالب</th>
                <th>اسم الطالب</th>
                <th>عنوان الطالب</th>
            </tr>
            <?php
            while($row=mysqli_fetch_array($res)){
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['address']."</td>";
                echo "</tr>";

            }
            
            
            
            
            ?>





         </table>
         </main>



    </div>
</body>
</html>