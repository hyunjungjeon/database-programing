package DB;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class Assignment {

	private static String className = "oracle.jdbc.driver.OracleDriver";//오라클 드라이버의 이름
	private static String url = "jdbc:oracle:thin:@localhost:1521:xe";//jdbc를 이용해 오라클에 연결할 준비
	private static String user = "hr";
	private static String password = "1234";
	
	public static Connection getConnection() {
		Connection conn = null;
		
		//jdbc 드라이버 로드 및 오라클 접속
		try { //외부에 연결할 때 try catch문을 사용함 -> 오류를 알아내기 위해서
			Class.forName(className); 
			conn = DriverManager.getConnection(url, user, password);
			System.out.println("connection success");
			
		}catch(ClassNotFoundException cnfe) {  //드라이버 설정시 문제가 발생했을 때 오류출력
			System.out.println("failed db driver loadging\n"+cnfe.toString());
		}catch(SQLException sqle) {//DB연결에 문제가 있을 때 
			System.out.println("failed db connection\n"+sqle.toString());
		}catch(Exception e) {
			System.out.println("Unknown error"); //무슨 오류인지 모를 때 
		}
		
		return conn;
	}
	
	private void closeAll(Connection conn, PreparedStatement psmt, ResultSet rs) {
		try {
			if(rs != null) rs.close();
			if(psmt != null) psmt.close();
			if(conn != null) conn.close();
			System.out.println("All closed");
			
		}catch(SQLException sqle) {
			System.out.println("Error");
			sqle.printStackTrace();
		}
	}

	private void select() {
		Connection conn = null;
		PreparedStatement psmt = null; //객체
		ResultSet rs = null;
		String sql = "select * from ( select * from countries order by rownum desc )where rownum = 1";		
		
		// 오라클에 쿼리 전송 및 결과값 반환
		try {
			conn = getConnection();
			psmt = conn.prepareStatement(sql); 
			rs = psmt.executeQuery(); //객체에 실제 쿼리를 동작시키게 하는 스트링이 들어감, 실행시 반환되는 값을 rs에 넣어줌
			while(rs.next()) { //next()메서드를 통해 하나씩 단계별로 읽어올 수 있음
				System.out.print("country_id: "+rs.getString("country_id"));
				System.out.print("\tcountry_name: "+rs.getString("country_name"));
				System.out.println("\tregion_id:"+rs.getString("region_id"));
			}	
			
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn,  psmt, rs);
		}
	}
	
	private void update() {
		Connection conn = null;
		PreparedStatement psmt = null; //객체
		String sql = "update countries set country_name = 'Zeroze' where country_id = 'ZZ'";
		
		// 오라클에 쿼리 전송 및 결과값 반환
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql); 
			int count = psmt.executeUpdate(); //객체에 실제 쿼리를 동작시키게 하는 스트링이 들어감, 실행시 반환되는 값을 rs에 넣어줌
			System.out.println(count +" row updated");
		
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn,  psmt, null);
		}
	}
	
	private void insert() {
		Connection conn = null;
		PreparedStatement psmt = null; //객체
		String sql = "insert into countries values ('ZZ','ZEROZE',3)";
		
		// 오라클에 쿼리 전송 및 결과값 반환
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql); 
			int count = psmt.executeUpdate(); //객체에 실제 쿼리를 동작시키게 하는 스트링이 들어감, 실행시 반환되는 값을 rs에 넣어줌
			System.out.println(count +" row inserted");			
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn,  psmt, null);
		}
	}
	
	private void delete() {
		Connection conn = null;
		PreparedStatement psmt = null; //객체
		String sql = "delete from countries where country_id = 'ZZ'";
		
		// 오라클에 쿼리 전송 및 결과값 반환
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql); 
			int count = psmt.executeUpdate(); //객체에 실제 쿼리를 동작시키게 하는 스트링이 들어감, 실행시 반환되는 값을 rs에 넣어줌
			System.out.println(count +" row inserted");			
			
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn,  psmt, null);
		}
	}



	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Assignment so = new Assignment();
		so.select();
		so.insert();
		so.select();
		so.update();
		so.select();
		so.delete();
		so.select();
	

	}
}
