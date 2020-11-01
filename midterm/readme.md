## 중간고사

### 개발 환경 소개
------------
+ MariaDB vs MySQL
> MariaDB 개발이 좀 더 개방적이고 활발하며 빠르고 투명한 보안패치를 릴리즈한 MariaDB를 선택했다.
> MySQL보다 MariaDB가 좀 더 가벼워 선택하게 되었다.

+ 리눅스 vs 윈도우
> 보통 개발시 윈도우보다 리눅스를 추천하는 이유는 운영 비용을 줄일 수 있다는 장점이 있기 때문이다. 
> 현업에서 리눅스가 많이 사용되고 있기 때문에 과제를 할 때 리눅스를 사용하게 되면 추후 개발직으로 가게 되면 조금이나마 도움이 되지 않을까 싶어 리눅스를 선택하게 되었다.

+ html, css 

### 발견한 정보
+ sakila
> 평소 관심사라고 할 만한 것이 없어 캐글을 둘러보아도 마음에 드는 DB가 없어 기본 샘플 데이터인 sakila를 사용했다.
+ 영화 전체 목록을 film_id 오름차순으로 출력
![1](https://user-images.githubusercontent.com/70558461/97818820-1aa5dc80-1ce8-11eb-837a-d3fc4310b598.PNG)
> film, film_actor, actor_info, language테이블을 조인해서 영화 전체 목록을 보여준다.

+ 카테고리 별 영화 출력
![2](https://user-images.githubusercontent.com/70558461/97818219-a0c02400-1ce4-11eb-9f5a-66a59f37c160.PNG)
> film, film_category, category를 조인하여 select로 카테고리를 선정하면 선정한 카테고리로 영화를 출력한다.

+ 고객 별 정보 조회
![3](https://user-images.githubusercontent.com/70558461/97818355-53908200-1ce5-11eb-818f-14fb9c0bffeb.PNG)
> customer, pyment를 조인하여 고객의 정보와 고객이 DVD에 사용한 총 가격을 보여준다.

### 동작화면
------------
- https://youtu.be/bsMHxGdxhEQ
