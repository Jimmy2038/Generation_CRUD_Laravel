
package generationcrudlaravel;

import classe.Champ;
import classe.Modele;
import java.io.*;

public class GenerationCrudLaravel {
    public static void main(String[] args) {
//        id | designation | description | surface | duree
        Champ [] champ = new Champ[3];
//        champ[0] = new Champ("type","Label","colonneBase","Place holder");
        champ[0] = new Champ("select","Choix équipe","equipe","Choisisser votre équipe");
        champ[1] = new Champ("select","Choix étape","etape","Choisisser votre étape");
        champ[2] = new Champ("text","Penalite","penalite","hh:mm:ss");
        
        
        
        Modele modele = new Modele("penalite_equipe",champ);
        modele.generateAll();
    }
}
