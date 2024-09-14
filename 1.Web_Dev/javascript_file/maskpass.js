// 실제 비밀번호 값을 저장하는 전역 변수
var actualPassword = '';

function maskPassword(input) {
    console.log("maskPassword called");

    var realPasswordInput = document.getElementById("realPass");

    // 입력된 키를 추출
    var inputChar = input.value[input.value.length - 1];

    // Backspace 처리
    if (input.value.length < actualPassword.length) {
        actualPassword = actualPassword.slice(0, -1);
    } else {
        actualPassword += inputChar;
    }
    
    console.log("Actual password: ", actualPassword);

    // 실제 비밀번호 값을 숨겨진 필드에 저장
    realPasswordInput.value = actualPassword;
    console.log("realPass hidden field value: ", realPasswordInput.value);

    // 입력된 비밀번호를 마스킹하여 화면에 표시
    var maskedPassword = actualPassword.replace(/./g, "*");
    console.log("Masked password: ", maskedPassword);

    // 마스킹된 값을 입력 필드에 설정
    input.value = maskedPassword;
    
    // 커서 위치를 유지
    var cursorPosition = actualPassword.length;
    input.setSelectionRange(cursorPosition, cursorPosition);
    console.log("Cursor position: ", cursorPosition);
}
