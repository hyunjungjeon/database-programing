20181002 전현정

### 문제 발생 내용
+ 리눅스를 사용해서 mariaDB에 sakila를 넣는 게 어려웠음
> 처음에 window에서 리눅스로 파일을 옮기려고 하니까 옮겨지지 않고 계속 오류가 났다. 복사가 됐다고 하는데 리눅스에서 열어보면 파일이 존재하지 않아 포기하고 싶었다.
> 수업시간에 employees DB를 다운 받을 때 git에서 다운을 받았던 것이 기억나 git에 sakilaDB를 따로 저장하여 리눅스에 git으로 sakilaDB를 복사해서 mariaDB에 넣었다
> 그 후 sakila-schema.sql를 먼저 넣고 data를 넣어야하는데 data부터 넣어서 오류가 났다.

### 참고 
+ mariaDB 장점
https://dtaxi.tistory.com/964
+ CSS 참고
https://www.codingfactory.net/css-tutorial-table-of-contents
> 위 사이트에서 많은 걸 참조함

### 회고
+ 스스로 실습해보면서 join을 하다보니 DB 구조에 대해 좀 더 자세히 알 수 있어서 좋았다. 테이블을 back, next하는 페이징기법을 이용해 테이블을 앞 뒤 페이지로 움직일 수 있게 하여 뿌듯했다.(+)
+ sakilaDB를 git으로 다운받고 나서 mariaDB에 sakila-schema부터 넣어야했는데 data부터 넣었다. 생각을 해보면 구조가 없는데 데이터를 넣으니 오류가 나는게 당연했는데 생각을 안하고 데이터부터 무작정 넣어서 오류가 났다. 생각을 좀 하고 실습하자(-)
+ 다음에는 kaggle에서 DB를 다운받아 사용해보고싶다(!)
