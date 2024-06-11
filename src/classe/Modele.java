/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package classe;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

/**
 *
 * @author Jimmy
 */
public class Modele {
    String nom;
    Champ [] champ;
    
    public Modele(String nom,Champ [] champ){
        this.nom=nom;
        this.champ=champ;
    }
    
    public void generateAll(){
        this.generateView();
        this.generateController();
        this.generateModele();
        this.generateRoute();
    }
    
    public void generateView(){
        String template = "C:\\Users\\Jimmy\\Documents\\NetBeansProjects\\GenerationCrudLaravel\\crud.blade.php";

        String resultat = "C:\\Users\\Jimmy\\Documents\\NetBeansProjects\\GenerationCrudLaravel\\Crud\\"+this.nom+".blade.php";


        StringBuilder contenuTemplate = new StringBuilder();
        try (BufferedReader br = new BufferedReader(new FileReader(template))) {
            String line;
            while ((line = br.readLine()) != null) {
                contenuTemplate.append(line).append(System.lineSeparator());
            }
        } catch (IOException e) {
            e.printStackTrace();
            return;
        }
            

        // Écrire le contenu modifié dans le fichier de sortie
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(resultat))) {
            String allForm ="";
            String modalForm ="";
            for(int i=0;i<champ.length;i++){
                allForm += this.generateChampField(champ[i]);
                modalForm += this.generateChampModale(champ[i]);
            }
            String liste = this.generateListe(champ);
            String script = this.generateScript(champ);
            String contenuModifie = contenuTemplate.toString()
                .replace("[#Champ]", allForm)
                .replace("[#ChampModal]", modalForm)
                .replace("[#classe]",this.nom)
                .replace("[#liste]",liste)
                .replace("[#script]",script);  
            writer.write(contenuModifie);
            
        } catch (IOException e) {
            e.printStackTrace();
        }

    }
    
    public String generateChampField(Champ champ) {
        String value="";
        if(champ.type!="select"){
            value = "<div class=\"form-group\">\n" +
                "    <label for=\"" + champ.nom + "\">" + champ.label + "</label>\n" +
                "    <input type=\"" + champ.type + "\" class=\"form-control @error('" + champ.nom + "') is-invalid @enderror\" id=\"" + champ.nom + "\" name=\"" + champ.nom + "\" placeholder=\"" + champ.placeholder + "\">\n" +
                "    @error('" + champ.nom + "')\n" +
                "    <div class=\"invalid-feedback\">{{ $message }}</div>\n" +
                "    @enderror\n" +
                "</div>\n";
        }else{
            value = "              <div class=\"form-group \">\n" +
"                    <label for=\"" + champ.nom + "\">"+ champ.label +"</label>\n" +
"                    <select class=\"form-control\" name=\""+ champ.nom +"\">\n" +
"                        @foreach($" + champ.nom + "s as $row)\n" +
"                            <option value=\"{{$row->id}}\">{{$row->"+ champ.nom +"}}</option>\n" +//" + champ.nom + " atao ao arinan'ny $row->id
"                        @endforeach\n" +
"                    </select>\n" +
"                    @error('"+ champ.nom +"')\n" +
"                    <div class=\"invalid-feedbpack\">{{ $message }}</div>\n" +
"                    @enderror\n" +
"                </div>\n";
        }
        return value;
    }
    
    public String generateChampModale(Champ champ) {
        String value="";
        if(champ.type!="select"){
            value = "<div class=\"form-group\">\n" +
                "    <label for=\"" + champ.nom + "_modal\">" + champ.label + "</label>\n" +
                "    <input type=\"" + champ.type + "\" id=\"" + champ.nom + "_modal\" class=\"form-control @error('" + champ.nom + "modal') is-invalid @enderror\" id=\"" + champ.nom + "modal\" name=\"" + champ.nom + "modal\" placeholder=\"" + champ.placeholder + "\">\n" +
                "    @error('" + champ.nom + "modal')\n" +
                "    <div class=\"invalid-feedback\">{{ $message }}</div>\n" +
                "    @enderror\n" +
                "</div>\n";
        }
            else{
                      value = "              <div class=\"form-group \">\n" +
"                    <label for=\"" + champ.nom + "\">"+champ.label+"</label>\n" +
"                    <select class=\"form-control\" name=\""+ champ.nom +"modal\">\n" +
"                        @foreach($" + champ.nom + "s as $row)\n" +
"                            <option value=\"{{$row->id}}\">{{$row->"+ champ.nom +"}}</option>\n" + //" + champ.nom + " atao ao arinan'ny $row->id
"                        @endforeach\n" +
"                    </select>\n" +
"                    @error('"+ champ.nom +"modal')\n" +
"                    <div class=\"invalid-feedbpack\">{{ $message }}</div>\n" +
"                    @enderror\n" +
"                </div>\n";
        }
        return value;
    }
    
    public String generateListe(Champ[] champs) {
        StringBuilder code = new StringBuilder();

        // Ouvrir la balise <thead> et la première ligne de l'en-tête
        code.append("<thead>\n");
        code.append("    <tr>\n");
        code.append("        <th>id").append(this.nom).append("</th>\n");

        // Ajouter les en-têtes de colonne pour chaque champ
        for (int i = 0; i < champs.length; i++) {
            code.append("        <th>").append(champs[i].label).append("</th>\n");
        }

        // Fermer la première ligne de l'en-tête et la balise <thead>
        code.append("        <th>Action</th>\n");
        code.append("    </tr>\n");
        code.append("</thead>\n");

        // Ouvrir la balise <tbody> et la boucle foreach
        code.append("<tbody>\n");
        code.append("@foreach($").append(this.nom).append("s as $row)\n");
        code.append("    <tr>\n");
        code.append("        <td>{{$row->id").append("}}</td>\n");// manampy nom .append(this.nom) eo alohanle append

        // Ajouter les colonnes pour chaque champ
        for (int i = 0; i < champs.length; i++) {
            code.append("        <td>{{$row->").append(champs[i].nom).append("}}</td>\n");
        }

        // Ajouter les boutons d'action
        code.append("        <td>\n");
        code.append("            <button class=\"btn btn-primary\"\n");
        code.append("                    onclick=\"openModal('{{$row->id").append("}}'");// manampy nom .append(this.nom) eo alohanle append
        for (int i = 0; i < champs.length; i++) {
            code.append(", '{{$row->").append(champs[i].nom).append("}}'");
        }
        code.append(")\"><i class=\"fe fe-edit-2\"></i></button>\n");
        code.append("            <button class=\"btn btn-danger\"><a href=\"{{ url('").append(this.nom).append("/delete/'.$row->id").append(") }}\"><i class=\"fe fe-trash-2\"></i></a></button>\n");// manampy nom .append(this.nom) eo alohanle append
        code.append("        </td>\n");

        // Fermer la boucle foreach et la balise <tbody>
        code.append("    </tr>\n");
        code.append("@endforeach\n");
        code.append("</tbody>\n");

        return code.toString();
    }
    
    public String generateScript(Champ[] champs) {
        StringBuilder code = new StringBuilder();

        code.append("<script>\n");
        code.append("function openModal(id"+this.nom+", ");

        // Ajouter les noms des champs
        for (int i = 0; i < champs.length; i++) {
            code.append(champs[i].nom);
            if (i < champs.length - 1) {
                code.append(", ");
            }
        }

        code.append(") {\n");
        code.append("    document.getElementById('id"+this.nom+"').value = id"+this.nom+";\n");

        // Ajouter la logique pour les autres champs
        for (Champ champ : champs) {
            code.append("    document.getElementById('").append(champ.nom).append("_modal').value = ").append(champ.nom).append(";\n");
        }

        code.append("    $('#exampleModal').modal('show');\n");
        code.append("}\n");
        code.append("</script>\n");

        return code.toString();
    }

    public void generateController() {
        String template = "C:\\Users\\Jimmy\\Documents\\NetBeansProjects\\GenerationCrudLaravel\\ControllerTemplate.php";
        String resultat = "C:\\Users\\Jimmy\\Documents\\NetBeansProjects\\GenerationCrudLaravel\\Crud\\" + this.capitalize(this.nom) +"Controller.php";

        StringBuilder contenuTemplate = new StringBuilder();
        try (BufferedReader br = new BufferedReader(new FileReader(template))) {
            String line;
            while ((line = br.readLine()) != null) {
                contenuTemplate.append(line).append(System.lineSeparator());
            }
        } catch (IOException e) {
            e.printStackTrace();
            return;
        }
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(resultat))) {
            String contenuModifie = contenuTemplate.toString()
                    .replace("[#Classe]", this.capitalize(this.nom))
                    .replace("[#variable]", this.nom.toLowerCase())
                    .replace("[#champ]", this.generateChampsValidation())
                    .replace("[#champmodale]", this.generateChampModal())
                    .replace("[#selects]", this.generateSelect())
                    .replace("[#select]",this.generateSelectController());
            
                    
            writer.write(contenuModifie);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    public String generateSelect(){
        StringBuilder code = new StringBuilder();
        for (int i = 0; i < this.champ.length; i++) {
            if(this.champ[i].type=="select"){
                code.append("'").append(champ[i].nom).append("s' => $").append(champ[i].nom).append(",");
            }else{
                code.append("");
            }
        }
        return code.toString();
    }
    
    public String generateSelectController(){
        StringBuilder code = new StringBuilder();
        for (int i = 0; i < this.champ.length; i++) {
            if(this.champ[i].type=="select"){
                code.append("$").append(champ[i].nom).append("=").append("DB::select(\"SELECT * FROM ").append(champ[i].nom).append("\");");//code.append("$").append(champ[i].nom).append("=").append(this.capitalize(champ[i].nom)).append("::all();");
            }else{
                code.append("");
            }
        }
        return code.toString();
    }
    
       public void generateModele() {
        String template = "C:\\Users\\Jimmy\\Documents\\NetBeansProjects\\GenerationCrudLaravel\\ModeleTemplate.php";
        String resultat = "C:\\Users\\Jimmy\\Documents\\NetBeansProjects\\GenerationCrudLaravel\\Crud\\" + this.capitalize(this.nom) +".php";

        StringBuilder contenuTemplate = new StringBuilder();
        try (BufferedReader br = new BufferedReader(new FileReader(template))) {
            String line;
            while ((line = br.readLine()) != null) {
                contenuTemplate.append(line).append(System.lineSeparator());
            }
        } catch (IOException e) {
            e.printStackTrace();
            return;
        }
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(resultat))) {
            String contenuModifie = contenuTemplate.toString()
                    .replace("[#Classe]", this.capitalize(this.nom))
                    .replace("[#variable]", this.nom.toLowerCase())
                    .replace("[#champmodale]", this.generateChampsModele())
                    .replace("[#champ]", this.generateSimpleChamps());
            writer.write(contenuModifie);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
       
    public void generateRoute() {
        String template = "C:\\Users\\Jimmy\\Documents\\NetBeansProjects\\GenerationCrudLaravel\\RouteTemplate.php";
        String resultat = "C:\\Users\\Jimmy\\Documents\\NetBeansProjects\\GenerationCrudLaravel\\Crud\\" + this.capitalize(this.nom) +"Route.php";

        StringBuilder contenuTemplate = new StringBuilder();
        try (BufferedReader br = new BufferedReader(new FileReader(template))) {
            String line;
            while ((line = br.readLine()) != null) {
                contenuTemplate.append(line).append(System.lineSeparator());
            }
        } catch (IOException e) {
            e.printStackTrace();
            return;
        }
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(resultat))) {
            String contenuModifie = contenuTemplate.toString()
                    .replace("[#Classe]", this.capitalize(this.nom))
                    .replace("[#variable]", this.nom.toLowerCase());                   
            writer.write(contenuModifie);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    private String generateChampsValidation() {
        StringBuilder validationCode = new StringBuilder();
        for (int i=0;i<champ.length;i++) {
            validationCode.append("'").append(champ[i].nom).append("' => 'required',\n");
        }
        return validationCode.toString();
    }
    private String generateChampModal() {
        StringBuilder validationCode = new StringBuilder();
        for (int i=0;i<champ.length;i++) {
            validationCode.append("'").append(champ[i].nom).append("modal' => 'required',\n");
        }
        return validationCode.toString();
    }
   
    private String generateChampsModele() {
        StringBuilder validationCode = new StringBuilder();
        for (int i=0;i<champ.length;i++) {
            validationCode.append("'").append(champ[i].nom).append("' => $data['").append(champ[i].nom).append("modal'],\n");
        }
        return validationCode.toString();
    }
    
    private String generateSimpleChamps() {
        StringBuilder validationCode = new StringBuilder();
        for (int i=0;i<champ.length;i++) {
            validationCode.append("'").append(champ[i].nom).append("' => $data['").append(champ[i].nom).append("'],\n");
        }
        return validationCode.toString();
    }

    private String capitalize(String str) {
        if (str == null || str.isEmpty()) {
            return str;
        }
        return str.substring(0, 1).toUpperCase() + str.substring(1);
    }

}
