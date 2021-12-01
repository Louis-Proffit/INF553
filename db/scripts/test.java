package db.scripts;

import java.sql.Connection;
import java.sql.DatabaseMetaData;
import java.sql.DriverManager;
import java.sql.SQLException;

public class test {

    private static final String host = "localhost";
    private static final String port = "5432";
    private static final String dbName = "postgres";
    private static final String serverUrl = "jdbc:postgresql://" + host + ":" + port + "/" + dbName;

    public static void main(String[] args) throws SQLException {

        try {
            Class.forName("org.postgresql.Driver");
        } catch (ClassNotFoundException e) {
            System.out.println("Driver not found!");
        }
        Connection connection = DriverManager.getConnection(serverUrl, "postgres", "postgres");
        DatabaseMetaData dmd = connection.getMetaData();
        String serverName = dmd.getDatabaseProductName();
        String productVersion = dmd.getDatabaseProductVersion();

        System.out.println("Server : " + serverName);
        System.out.println("Product version : " + productVersion);
    }
}