function doGet(){
    return HtmlService.createTemplateFromFile('otp_ver.php')
    .evaluate()
    .addMetaTag('viewport','width=device=width,inital-scale=1')
    .setXFrameOptionsMode(HtmlService.setXFrameOptionsMode.ALLOWALL);

}
    function sendOTP(){
    const email = document.getElementById('email');
    const otp = document.getElementsByClassName('otp')[0];
    const otpverify = document.getElementsByClassName('otpverify')[0];

    // Generating random number as OTP;

    let otp_val = Math.floor(Math.random()*10000);

    let emailbody = `
        <h1>ระะบบสมัครสมาชิก</h1> <br>
        <h2>Your OTP is </h2>${otp_val}
    `;

    Email.send({
        Host:"smtp.elasticemail.com",
        Username:email.value,
        Password:"1F5D521483004A336CB75C89B6635A3BE645",
        To : email.value,
        From : "brownza1250@gmail.com",
        Subject : "OTP is ",
        Body : emailbody
    }).then(
        //if success it returns "OK";
      message => {
        if(message === "OK"){
            // now making otp input visible
            otp.style.display="none";
            otpverify.style.display = "block";
            const otp_inp = document.getElementById('otp_inp');
            const otp_btn = document.getElementById('otp-btn');

            otp_btn.addEventListener('click',()=>{
                // now check whether sent email is valid
                if(otp_inp.value == otp_val){
                   window.location='register.php';
                    alert("Email address verified...");
                }
                else{
                    alert("Invalid OTP");
                }
            })
        }
      }
    );

}