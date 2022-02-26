package projetssad;

import java.io.IOException;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

public class Ministere_acceuilController {

	@FXML
    public TextField idH;

    @FXML
    public TextField idS;
    
    static String idHstatic;
    static String idSstatic;
    		
	
	@FXML
    void authentification(ActionEvent event) throws IOException {
		Main.stage.close(); 
        Parent parent = FXMLLoader.load(getClass().getResource("Authentification.fxml"));
        Scene scene = new Scene(parent);
        Stage stage = new Stage();
        stage.setScene(scene);
        stage.show();
        stage.setResizable(false);
        Main.stage = stage;
        stage.setTitle("Menu");
    }
	
	@FXML
    void consulterInfoPerso(ActionEvent event) throws IOException {
		idHstatic=idH.getText(); 
		idSstatic=idS.getText(); 
		
		Main.stage.close(); 
		Parent parent = null;
		
		
		//reconnaitre a quel wilaya appartien l'hopital
				Connection cnx = Main.connection;
				
				Statement myStmt = null;
				try {
					myStmt = cnx.createStatement();
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				} 
		        ResultSet myRs = null;
				try {
					myRs = myStmt.executeQuery("Select idHopital, wilaya FROM hopital"); 
					
					//parcourir la table hopital et recuperer la wilaya de l'hopital souhait�
					while(myRs.next())
					{
						if(myRs.getString("idHopital").equals(idH.getText()))
						{
							//si l'hopital fait partie des 29 premieres wilaya --> afficher le premier type de logiciel
							if(Integer.valueOf(myRs.getString("wilaya"))<=29)
							{
								parent = FXMLLoader.load(getClass().getResource("Ministere_ConsulterInfosPersoPatient_cas1.fxml"));
							}
							else {
								parent = FXMLLoader.load(getClass().getResource("Ministere_ConsulterInfosPersoPatient_cas2.fxml"));
						        
							}
						}
					}
					
					 
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
		Scene scene = new Scene(parent);
        Stage stage = new Stage();
        stage.setScene(scene);
        stage.show();
        stage.setResizable(false);
        Main.stage = stage;
        
    }
	
	@FXML
    void consulterInfoMed(ActionEvent event) throws IOException {
		idHstatic=idH.getText(); 
		idSstatic=idS.getText(); 
		
		Main.stage.close(); 
		Parent parent = null;
		
		
		
		//reconnaitre a quel wilaya appartien l'hopital
		Connection cnx = Main.connection;
		
		Statement myStmt = null;
		try {
			myStmt = cnx.createStatement();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} 
        ResultSet myRs = null;
		try {
			myRs = myStmt.executeQuery("Select idHopital, wilaya FROM hopital"); 
			
			//parcourir la table hopital et recuperer la wilaya de l'hopital souhait�
			while(myRs.next())
			{
				if(myRs.getString("idHopital").equals(idH.getText()))
				{
					//si l'hopital fait partie des 29 premieres wilaya --> afficher le premier type de logiciel
					if(Integer.valueOf(myRs.getString("wilaya"))<=29)
					{
						parent = FXMLLoader.load(getClass().getResource("Ministere_consulterInfoMed1.fxml"));
					}
					else {
						parent = FXMLLoader.load(getClass().getResource("Ministere_consulterInfoMed2.fxml"));
				        
					}
				}
			}
			
			 
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
        Scene scene = new Scene(parent);
        Stage stage = new Stage();
        stage.setScene(scene);
        stage.show();
        stage.setResizable(false);
        Main.stage = stage;
       
    }
	
	
}
