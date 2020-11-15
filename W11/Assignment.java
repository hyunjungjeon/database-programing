package DB;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class Assignment {

	private static String className = "oracle.jdbc.driver.OracleDriver";//����Ŭ ����̹��� �̸�
	private static String url = "jdbc:oracle:thin:@localhost:1521:xe";//jdbc�� �̿��� ����Ŭ�� ������ �غ�
	private static String user = "hr";
	private static String password = "1234";
	
	public static Connection getConnection() {
		Connection conn = null;
		
		//jdbc ����̹� �ε� �� ����Ŭ ����
		try { //�ܺο� ������ �� try catch���� ����� -> ������ �˾Ƴ��� ���ؼ�
			Class.forName(className); 
			conn = DriverManager.getConnection(url, user, password);
			System.out.println("connection success");
			
		}catch(ClassNotFoundException cnfe) {  //����̹� ������ ������ �߻����� �� �������
			System.out.println("failed db driver loadging\n"+cnfe.toString());
		}catch(SQLException sqle) {//DB���ῡ ������ ���� �� 
			System.out.println("failed db connection\n"+sqle.toString());
		}catch(Exception e) {
			System.out.println("Unknown error"); //���� �������� �� �� 
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
		PreparedStatement psmt = null; //��ü
		ResultSet rs = null;
		String sql = "select * from ( select * from countries order by rownum desc )where rownum = 1";		
		
		// ����Ŭ�� ���� ���� �� ����� ��ȯ
		try {
			conn = getConnection();
			psmt = conn.prepareStatement(sql); 
			rs = psmt.executeQuery(); //��ü�� ���� ������ ���۽�Ű�� �ϴ� ��Ʈ���� ��, ����� ��ȯ�Ǵ� ���� rs�� �־���
			while(rs.next()) { //next()�޼��带 ���� �ϳ��� �ܰ躰�� �о�� �� ����
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
		PreparedStatement psmt = null; //��ü
		String sql = "update countries set country_name = 'Zeroze' where country_id = 'ZZ'";
		
		// ����Ŭ�� ���� ���� �� ����� ��ȯ
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql); 
			int count = psmt.executeUpdate(); //��ü�� ���� ������ ���۽�Ű�� �ϴ� ��Ʈ���� ��, ����� ��ȯ�Ǵ� ���� rs�� �־���
			System.out.println(count +" row updated");
		
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn,  psmt, null);
		}
	}
	
	private void insert() {
		Connection conn = null;
		PreparedStatement psmt = null; //��ü
		String sql = "insert into countries values ('ZZ','ZEROZE',3)";
		
		// ����Ŭ�� ���� ���� �� ����� ��ȯ
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql); 
			int count = psmt.executeUpdate(); //��ü�� ���� ������ ���۽�Ű�� �ϴ� ��Ʈ���� ��, ����� ��ȯ�Ǵ� ���� rs�� �־���
			System.out.println(count +" row inserted");			
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn,  psmt, null);
		}
	}
	
	private void delete() {
		Connection conn = null;
		PreparedStatement psmt = null; //��ü
		String sql = "delete from countries where country_id = 'ZZ'";
		
		// ����Ŭ�� ���� ���� �� ����� ��ȯ
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql); 
			int count = psmt.executeUpdate(); //��ü�� ���� ������ ���۽�Ű�� �ϴ� ��Ʈ���� ��, ����� ��ȯ�Ǵ� ���� rs�� �־���
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
