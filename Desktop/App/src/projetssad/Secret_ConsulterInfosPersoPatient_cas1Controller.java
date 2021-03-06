/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetssad;

import java.net.URL;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ComboBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import classes.patient;
import java.io.IOException;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author user
 */
public class Secret_ConsulterInfosPersoPatient_cas1Controller implements Initializable {
 
    @FXML TableView<patient> table_pat;
    @FXML TableColumn id_patient;
    @FXML TableColumn nom;
    @FXML TableColumn prenom;
    @FXML TableColumn tel1;
    @FXML TableColumn tel2;
    @FXML TableColumn nom_med;
    @FXML TableColumn prenom_med;
    @FXML TextField nom_hopital;
    @FXML TextField nom_service;
    
    String nomMed="",prenomMed="";
    
    static int idP;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            id_patient.setCellValueFactory(new PropertyValueFactory<>("id_patient"));
            nom.setCellValueFactory(new PropertyValueFactory<>("nom"));
            prenom.setCellValueFactory(new PropertyValueFactory<>("prenom"));
            tel1.setCellValueFactory(new PropertyValueFactory<>("tel1"));
            tel2.setCellValueFactory(new PropertyValueFactory<>("tel2"));
            nom_med.setCellValueFactory(new PropertyValueFactory<>("nom_med"));
            prenom_med.setCellValueFactory(new PropertyValueFactory<>("prenom_med"));
            
            Connection cnx = Main.connection;
            ArrayList<patient> liste_patient= new ArrayList<>();
            
            Statement myStmt = cnx.createStatement();
            Statement myStmt2 = cnx.createStatement();
            
            ResultSet myRs = myStmt.executeQuery("SELECT `idPatient`, `nom`, `prenom`,`tel1`, `tel2`,`idMedecin` FROM `patient` WHERE idHopital="+AuthentificationController.idH_Secretaire+" AND idService="+AuthentificationController.idS_Secretaire+"");
            
              
            while(myRs.next())
            {
                ResultSet myRs2 = myStmt2.executeQuery("SELECT `nom`, `prenom` FROM `medecin` WHERE `idMedecin` = "+myRs.getInt("idMedecin")+"");
                
                while(myRs2.next()){
                        nomMed = myRs2.getString("nom");
                        prenomMed = myRs2.getString("prenom");
                }     
                patient p = new patient(myRs.getInt("idPatient"),myRs.getString("nom"),myRs.getString("prenom"),myRs.getString("tel1"),myRs.getString("tel2"),nomMed,prenomMed);
                liste_patient.add(p);
                
            }
            
            ObservableList<patient> listObservable = FXCollections.observableArrayList(liste_patient);
            table_pat.setItems(listObservable);
            table_pat.getSortOrder().add(nom);
            
            Statement myStmt3 = cnx.createStatement();
            
            //R??cup??rer le nom de l'hopital et du service
            ResultSet Rs = myStmt3.executeQuery("Select h.nomHopital , s.nomService From hopital h, service s Where h.idHopital = "+AuthentificationController.idH_Secretaire+" AND s.idService = "+AuthentificationController.idS_Secretaire+" ");
            if (Rs.next())
            {
                nom_hopital.setText(Rs.getString("nomHopital"));
                nom_service.setText(Rs.getString("nomService"));
            }
            
            
        } catch (SQLException ex) {
            Logger.getLogger(Secret_ConsulterInfosPersoPatient_cas1Controller.class.getName()).log(Level.SEVERE, null, ex);
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
    
    public void DetailPatient(ActionEvent event) throws IOException, SQLException
    {
        //si une ligne du tableau est s??lectionn??e 
         if(table_pat.getSelectionModel().isSelected(table_pat.getSelectionModel().getSelectedIndex()))
        {
            patient p = table_pat.getSelectionModel().getSelectedItem();
            idP = p.getId_patient();
            
            Main.stage.close(); 
            Parent parent = FXMLLoader.load(getClass().getResource("Secr_ConsulterD??tailsInfosPerso_C1.fxml"));
            Scene scene = new Scene(parent);
            Stage stage = new Stage();
            stage.setScene(scene);
            stage.show();
            stage.setResizable(false);
            Main.stage = stage;
            stage.setTitle("Consulter les informations personnelles du patient");
            
        }else {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Erreur");
            alert.setHeaderText(null);
            alert.setContentText("Veuillez selectionner une ligne d'abord!");
            alert.show();
        }
    }
    
}
