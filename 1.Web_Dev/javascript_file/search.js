document.addEventListener('DOMContentLoaded', function() {
    var searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', handleSubmit);
    }
});

function handleSubmit(event) {
    event.preventDefault(); // 기본 폼 제출 동작을 막음
    performSearch();
    
    // 이벤트 리스너 제거
    var searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.removeEventListener('submit', handleSubmit);
    }
}

function performSearch() {
    var criteria = document.getElementById('searchCriteria').value;
    var board = document.getElementById('searchBoard').value;
    var query = document.getElementById('searchQuery').value;

    var createdStart = document.getElementById('created_start').value;
    var createdEnd = document.getElementById('created_end').value;

    if (criteria && query) {
        var form = document.createElement('form');
        form.method = 'get';
        form.action = 'board.php';

        var criteriaInput = document.createElement('input');
        criteriaInput.type = 'hidden';
        criteriaInput.name = 'criteria';
        criteriaInput.value = criteria;
        form.appendChild(criteriaInput);

        var boardInput = document.createElement('input');
        boardInput.type = 'hidden';
        boardInput.name = 'board';
        boardInput.value = board;
        form.appendChild(boardInput);

        var queryInput = document.createElement('input');
        queryInput.type = 'hidden';
        queryInput.name = 'query';
        queryInput.value = query;
        form.appendChild(queryInput);

        var createdStartInput = document.createElement('input');
        createdStartInput.type = 'hidden';
        createdStartInput.name = 'created_start';
        createdStartInput.value = createdStart;
        form.appendChild(createdStartInput);

        var createdEndInput = document.createElement('input');
        createdEndInput.type = 'hidden';
        createdEndInput.name = 'created_end';
        createdEndInput.value = createdEnd;
        form.appendChild(createdEndInput);

        document.body.appendChild(form);
        form.submit();
    } else {
        alert('검색 항목과 검색어를 입력해주세요.');
    }
}
