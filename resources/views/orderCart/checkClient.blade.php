<!DOCTYPE html>
<html>
  <head>
<script>
      function openForm() {
        document.getElementById("popupForm").style.display = "block";
      }
      function closeForm() {
        document.getElementById("popupForm").style.display = "none";
      }
</script>
<style>
        .center{
            position: absolute;
            top: 50%;
            left: 50%;
            background-color: #cc0000 !important;
            border: #19d153;
        }
      * {
        box-sizing: border-box;
      }
      .openBtn {
        display: flex;
        justify-content: left;
      }
      .openButton {
        border: none;
        border-radius: 5px;
        background-color: #19d153;
        color: white;
        padding: 14px 20px;
        cursor: pointer;
        position: fixed;
      }
      .loginPopup {
        position: relative;
        text-align: center;
        width: 100%;
      }
      .formPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
      }
      .formContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
      }
      .formContainer input[type=text],
      .formContainer input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
      }
      .formContainer input[type=text]:focus,
      .formContainer input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }
      .formContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #009fef;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
      }
      .formContainer .cancel {
        background-color: #cc0000;
      }
      .formContainer .btn:hover,
      .openButton:hover {
        opacity: 1;
      }
    </style>
  <body style="background-color: red; color: white">
    <div class="center">
        <div class="openBtn">
            <button class="openButton" onclick="openForm()"><strong>Enter PIN CODE</strong></button>
        </div>
        <div class="loginPopup">
            <div class="formPopup" id="popupForm">
                <form method="POST" action="{{route('checkClient')}}">
                    @csrf
                    <h2>Insert PIN</h2>
                    <label for="pinCode">
                        <strong>PIN CODE</strong>
                    </label>
                    <input type="hidden" name="client_id" value="{{$client_id}}">
                    <input type="hidden" name="KD_id" value="{{$KD_id}}">
                    <input type="hidden" name="total" value="{{$total}}">
                    <input type="password" id ="pinCode" placeholder="Your PIN" name="pinCode" min="4" max="4" style ="background-color: rgba(7, 252, 7, 0.874)" required>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
