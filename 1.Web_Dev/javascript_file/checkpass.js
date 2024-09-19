// 기존 코드 아래에 추가

function checkPassword() {
    var realPass1 = document.getElementById('pass1').value;
    var realPass2 = document.getElementById('pass2').value;

    console.log("Checking passwords:", realPass1, realPass2);  // 디버깅용

    if (realPass1 === realPass2) {
        alert("비밀번호가 일치합니다.");
        return true;
    } else {
        alert("비밀번호가 일치하지 않습니다.");
        console.log("Pass1:", realPass1);
        console.log("Pass2:", realPass2);
        return false;
    }
}