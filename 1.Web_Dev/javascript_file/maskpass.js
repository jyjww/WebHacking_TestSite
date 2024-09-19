// 실제 비밀번호 값을 저장하는 전역 변수
var actualPasswords = {'pass1': '', 'pass2': ''};

function maskPassword(input) {
    console.log("maskPassword called for", input.id);

    // 입력된 키를 추출
    var inputChar = input.value[input.value.length - 1] || '';

    // Backspace 처리
    if (input.value.length < actualPasswords[input.id].length) {
        actualPasswords[input.id] = actualPasswords[input.id].slice(0, -1);
    } else if (inputChar) {
        actualPasswords[input.id] += inputChar;
    }
    
    // 입력된 비밀번호를 마스킹하여 화면에 표시
    var maskedPassword = actualPasswords[input.id].replace(/./g, "*");
    // 마스킹된 값을 입력 필드에 설정
    input.value = maskedPassword;
    
    // 커서 위치를 유지
    var cursorPosition = actualPasswords[input.id].length;
    input.setSelectionRange(cursorPosition, cursorPosition);

    console.log("Actual Password for " + input.id + ": " + actualPasswords[input.id]);
}

// 페이지 로드 시 실행
window.onload = function() {
    var passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            maskPassword(this);
        });
    });
};