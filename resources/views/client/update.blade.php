<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile Update</title>
</head>
<body>

<div class="container">
  <form action="/client/update/edits" method="POST">
  @csrf
        @method('PUT')

        <label for="address">User Name</label>
    <input type="text" id="userName" name="userName" placeholder="user Name">
    <br>
    <label for="address">address</label>
    <input type="text" id="address" name="address" placeholder="address">
    <br>

    <label for="businessType">businessType</label>
    <select id="businessType" name="businessType">
      <option value="retail">retail</option>
      <option value="agri">agriculture</option>
      <option value="manufacture">manufacture</option>

    </select>
    <br>
    <label for="businessRegisteration">businessRegisteration</label>
    <input type="text" id="businessRegisteration" name="businessRegisteration" placeholder="">
    <br>
    <label for="mobile">mobile</label>
    <input type="text" id="mobile" name="mobile" placeholder="">
    <br>
   
    

    <input type="submit" value="Submit">

  </form>
 
</div>

</body>
</html>