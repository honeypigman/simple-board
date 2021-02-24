## About Project
- 기본적인 형태의 게시판 관리 및 관리자 화면 구현.
> 시스템 구성
> 1) 기본 게시판 
> 2) 유저관리
> 3) 접근로그
> 4) 코드관리

## How to Use
> 1) 프로젝트 경로로 이동
> 2) git clone
> ```git
> git clone https://github.com/honeypigman/simple-board.git ./
> ```
> 3) .env 파일 생성
> ```env
> APP_ENV=D
> APP_VER=1.0
> APP_NAME=[Proejct Name]
> APP_KEY=[GenerateKey]
> APP_DEBUG=true
> APP_URL=[Domain URL]
> ADMIN_EMAIL=[Admin Email Address]
> 
> LOG_CHANNEL=stack
> 
> DB_CONNECTION=[DB TYPE : mysql, pgsql ..]
> DB_HOST=[DB HOST ]
> DB_PORT=[DB PORT]
> DB_DATABASE=[DB NAME]
> DB_USERNAME=[DB USER]
> DB_PASSWORD=[DB PASSWORD]
> 
> BROADCAST_DRIVER=log
> CACHE_DRIVER=file
> QUEUE_CONNECTION=sync
> SESSION_DRIVER=file
> SESSION_LIFETIME=120
> 
> PER_PAGE=10
>```
> 4) Composer 설치
> ```
> composer install
> composer require doctrine/dbal:2.*
> ```
> 5) 라라벨 키 재생성
> ```php
> php artisan key:generate
> ```

## Based on following plugins or services
- PHP v7
- Apache v2.3
- Laravel v7.3
- Bootstrap v5
- Postgresql
- CKEditor4 [CKEDITOR](https://ckeditor.com/docs/ckeditor4/latest/index.html).

## Next Goals
- RestAPI Interface 구축
- 게시판 관리의 시스템화
- React, Nosql, Spring Boot ..


## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contact Me
- 오늘 역시 조금씩 꾸준하게 하자.
- 소스리뷰 및 조언 언제나 환영합니다. 
- honeypigman@gmail.com