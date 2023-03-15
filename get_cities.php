<?php
include 'connect.php';
if(isset($_POST['country_id'])){
  $stmt = $connect->prepare("SELECT * FROM cities WHERE country_id = ?");
  $stmt->execute(array($_POST['country_id']));
  $allcities = $stmt->fetchAll();
  foreach ($allcities as $city) {
?>
    <option value="<?php echo $city['id']; ?>"> <?php echo $city['name']; ?> </option>
<?php
  }
}
?>
