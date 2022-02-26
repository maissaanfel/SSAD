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
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.ComboBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author user
 */
public class Secr_ConsulterDétailsInfosPerso_C1Controller implements Initializable {

        
    @FXML TextField nomP;
    @FXML TextField prenomP;
    @FXML TextField tel1P;
    @FXML TextField tel2P;
    @FXML DatePicker date_naiss;
    @FXML ComboBox groupe_sanguin;
    @FXML ComboBox genre;
    @FXML TextField nomM;
    @FXML TextField prenomM;
    @FXML TextField nomService;
    @FXML TextField nomHopital;
    
    String nomMed="",prenomMed="";
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            Connection cnx = Main.connection;
            Statement myStmt = cnx.createStatement();
            Statement myStmt2 = cnx.createStatement();
            ResultSet myRs = myStmt.executeQuery("SELECT `nom`, `prenom`,`tel1`, `tel2`, `dateN`, `grpsanguin`,`genre`,h.nomHopital, s.nomService, `idMedecin` FROM `patient`, service s, hopital h WHERE `idPatient` = "+Secret_ConsulterInfosPersoPatient_cas1Controller.idP+" AND h.idHopital = "+AuthentificationController.idH_Secretaire+" AND s.idService = "+AuthentificationController.idS_Secretaire+" ");
           
            while(myRs.next()){
                ResultSet myRs2 = myStmt2.executeQuery("SELECT `nom`, `prenom` FROM `medecin` WHERE `idMedecin` = "+myRs.getInt("idMedecin")+"");
                
                while(myRs2.next()){
                        nomMed = myRs2.getString("nom");
                        prenomMed = myRs2.getString("prenom");
                }    
                DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");
                LocalDate ld = LocalDate.parse(myRs.getString("dateN"),formatter);
                
                date_naiss.setValue(ld);
                nomP.setText(myRs.getString("nom"));
                prenomP.setText(myRs.getString("prenom"));
                tel1P.setText(myRs.getString("tel1"));
                tel2P.setText(myRs.getString("tel2"));
                nomM.setText(nomMed);
                prenomM.setText(prenomMed);
                groupe_sanguin.setValue(myRs.getString("grpsanguin"));
                genre.setValue(myRs.getString("genre"));
                nomHopital.setText(myRs.getString("nomHopital"));
                nomService.setText(myRs.getString("nomService"));
            }
        } catch (SQLException ex) {
            Logger.getLogger(Secr_ConsulterDétailsInfosPerso_C1Controller.class.getName()).log(Level.SEVERE, null, ex);
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
    
    @FXML
    void Retour(ActionEvent event) throws IOException {

    	Main.stage.close(); 
        Parent parent = FXMLLoader.load(getClass().getResource("Menu2Secretaire_cas1.fxml"));
        Scene scene = new Scene(parent);
        Stage stage = new Stage();
        stage.setScene(scene);
        stage.show();
        stage.setResizable(false);
        Main.stage = stage;
        stage.setTitle("Menu cas1");
    }    
    
}
