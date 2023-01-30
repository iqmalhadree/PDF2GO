import java.io.File;
import java.io.IOException;
import java.util.Formatter;
import java.util.Scanner;

import org.apache.pdfbox.Loader;
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;
import org.apache.commons.io.FilenameUtils;

public class pdf_txt{
    public static void main(String[] args) throws IOException{ //Throw IO exception if found it

        File pdfFile = new File("java/uploads/log.pdf"); //Open pdf file uploaded from user

        try(PDDocument doc = Loader.loadPDF(pdfFile)){ //To parse the pdf file
            PDFTextStripper stripper= new PDFTextStripper();//read all the text in pdf file
            String text = stripper.getText(doc);//Store the text into the text variable

            //create new text file and write string text into it
            Formatter textFile = new Formatter("converted-uploads/convertedword.txt");
            textFile.format(text);//Write the text into file
            textFile.close();//Close file
        }
    }
}
