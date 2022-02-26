/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetssad;

import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author user
 */
public class Menu1AdminController implements Initializable {
    
    @FXML TextField idService;
    
    static int id_Service;
    
     public void InsertionSecretaire(ActionEvent event) throws SQLException, IOException
     {
        
        if( idService.getText().isEmpty()){
            
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Erreur");
            alert.setHeaderText(null);
            alert.setContentText("Veuillez remplir tous les champs!!");
            alert.show();
        }else{
            
            id_Service = Integer.parseInt(idService.getText());
            
            Connection cnx = Main.connection; 
            Statement myStmt = cnx.createStatement();
            ResultSet myRs = myStmt.executeQuery("SELECT `idService` FROM `service` WHERE `idHopital` ="+AuthentificationController.idH_Admin+" ");
            int test = 0;
            while(myRs.next()){
                if(id_Service == myRs.getInt("idService")){
                    test = 1;
                    Main.stage.close(); 
                    Parent parent = FXMLLoader.load(getClass().getResource("Admin_AjouterSecretaire.fxml"));
                    Scene scene = new Scene(parent);
                    Stage stage = new Stage();
                    stage.setScene(scene);
                    stage.show();
                    stage.setResizable(false);
                    Main.stage = stage;
                    stage.setTitle("Inscription d'une secrétaire");
                }
            }
            
            if(test == 0){
                Alert alert = new Alert(Alert.AlertType.ERROR);
                alert.setTitle("Erreur");
                alert.setHeaderText(null);
                alert.setContentText("Veuillez entrer l'identifiant d'un service existant dans votre hopital!");
                alert.show();
            }
        }
    }
     
      public void InsertionMedecin(ActionEvent event) throws SQLException, IOException
    {
        
        if(idService.getText().isEmpty()){
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Erreur");
            alert.setHeaderText(null);
            alert.setContentText("Veuillez remplir tous les champs!!");
            alert.show();
        }else{
            id_Service = Integer.parseInt(idService.getText());
            
            Connection cnx = Main.connection; 
            Statement myStmt = cnx.createStatement();
            ResultSet myRs = myStmt.executeQuery("SELECT `idService` FROM `service` WHERE `idHopital` ="+AuthentificationController.idH_Admin+" ");
            
            int test = 0;
            while(myRs.next()){
                if(id_Service == myRs.getInt("idService")){
                    test = 1;
                    Main.stage.close(); 
                    Parent parent = FXMLLoader.load(getClass().getResource("Admin_AjouterMedecin.fxml"));
                    Scene scene = new Scene(parent);
                    Stage stage = new Stage();
                    stage.setScene(scene);
                    stage.show();
                    stage.setResizable(false);
                    Main.stage = stage;
                    stage.setTitle("Inscription d'un médecin");
                }
            }
             if(test == 0){
                Alert alert = new Alert(Alert.AlertType.ERROR);
                alert.setTitle("Erreur");
                alert.setHeaderText(null);
                alert.setContentText("Veuillez entrer l'identifiant d'un service existant dans votre hopital!");
                alert.show();
            }
        }
    }
    
    @FXML
    void Authentification(ActionEvent event) throws IOException {

    	Main.stage.close(); 
        Parent parent = FXMLLoader.load(getClass().getResource("Authentification.fxml"));
        Scene scene = new Scene(parent);
        Stage stage = new Stage();
        stage.setScene(scene);
        stage.show();
        stage.setResizable(false);
        Main.stage = stage;
        stage.setTitle("Acceuil");
    }
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    
    
}
