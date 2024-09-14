프로젝트 명: WebHacking TestSite

이 프로젝트는 웹 해킹 테스트를 목적으로 설계된 웹 사이트입니다. 주요 정보통신기반시설 기술적 취약점 평가 상세 가이드를 기반으로, 웹에서 발생할 수 있는 다양한 취약점을 가진 사이트를 개발하였습니다. 이 웹사이트는 모의해킹을 통해 각 취약점의 작동 방식을 이해하고 학습하는 데 중점을 두고 있습니다.

주의: 이 웹사이트는 학습 목적으로만 사용해야 하며, 실제 환경에서는 사용하지 않기를 권장드립니다. 프로젝트에는 다양한 취약점이 포함되어 있어, 잘못된 사용 시 보안 위협이 발생할 수 있습니다.

기술 스택:

- 웹 서버: Apache HTTP Server
- 데이터베이스: MySQL
- 프로그래밍 언어: PHP
- 프론트엔드: HTML, CSS, JavaScript

설치 및 실행 방법:

1. 환경 설정
   - Apache HTTP Server와 MySQL 데이터베이스를 설치합니다.
   - 웹 루트 디렉토리에 프로젝트 파일을 복사합니다.

2. 데이터베이스 설정
   - MySQL에서 새 데이터베이스를 생성하고, 프로젝트의 `database.sql` 파일을 실행하여 테이블을 초기화합니다.

3. Apache 설정
   - Apache 서버의 `httpd.conf` 파일이나 `vhost` 설정에서 이 프로젝트의 도메인이나 로컬 서버를 설정합니다.

4. 웹사이트 실행
   - Apache HTTP Server를 시작하고, 웹 브라우저에서 해당 도메인이나 `http://localhost`로 접속하여 웹사이트를 확인합니다.

주요 기능 및 학습 목표:

- SQL 인젝션(SQL Injection)
- 크로스 사이트 스크립팅(XSS)
- 파일 업로드 취약점
- CSRF(Cross-Site Request Forgery) 공격 시뮬레이션
- 디렉터리 리스팅 및 경로 탐색

라이선스:

이 프로젝트는 학습 목적으로 제공되며, 상업적 사용이나 실무 환경에서는 사용하지 않기를 권장합니다.
