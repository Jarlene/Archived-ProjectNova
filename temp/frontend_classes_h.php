<?php
/*
    This is the class declaration head file for information display.
    Quary classes not included.

    Author: Phoenix
    Version: 0611.2016

    Classes Index:
        - SearchResult: Represent a single row in the search results
        - BookDetail: Represent a book with all information needed for a Book Detail Page, EXCEPT LINKS AND COMMENTS.
        - BookLink: Represent a single row of the links for the book.
        - AuthorDetail: Represent an author with all information needed for an Author Detail Page, EXCEPT COMMENTS.
        - Commnet: Represent a single comment for a book or an author.
*/

class SearchResult {
    public $BID = '-';
    public $BName = '-';
    public $AID = '-';
    public $AName = '-';
    public $LCode = 'eng';
    public $GCode = '-';
    public $GName = '-';
    public $BRelease = '-';
    public $BUpdate = '-';

    private $BookDetailsURL = 'placeholder.php';
    private $AuthorDetailsURL = 'placeholder.php';
    private $FilterByGenreURL = 'placeholder.php';

    public function toHTMLTableRow(){
        return '<tr>
                    <td><a href="'.$this->BookDetailsURL.'?bid='.$this->BID.'&lcode='.$this->LCode.'">'.$this->BName.'</a></td>
                    <td><a href="'.$this->AuthorDetailsURL.'?bid='.$this->AID.'&lcode='.$this->LCode.'">'.$this->AName.'</a></td>
                    <td><a href="'.$this->FilterByGenreURL.'?gcode='.$this->GCode.'">'.$this->GName.'</a></td>
                    <td>'.$this->BRelease.'</td>
                    <td>'.$this->BUpdate.'</td>
                </tr>';
    }
}

class BookDetail {
    public $BID = '-';
    public $BName = '-';
    public $AID = '-';
    public $AName = '-';
    public $LCode = 'eng';
    public $GCode = '-';
    public $GName = '-';
    public $ORelease = '-';
    public $BRelease = '-';
    public $WCount = '-';
    public $BUpdate = '-';
    public $BDesc = '-';

    private $BookDetailsURL = 'placeholder.php';
    private $AuthorDetailsURL = 'placeholder.php';
    private $FilterByGenreURL = 'placeholder.php';

    public function getDetailsInOtherLanguageVersion($LCode){
        return $this->BookDetailsURL.'?bid='.$this->BID.'&lcode='.$LCode;
    }

    public function toHTMLDivision(){
        return  '<h2>'.$this->BName.'</h2>
                <table id="details_table">
                  <tr>
                    <td>Author</td>
                    <td><a href="'.$this->AuthorDetailsURL.'?bid='.$this->AID.'">'.$this->AName.'</a></td>
                  </tr>
                  <tr>
                    <td>Genre</td>
                    <td><a href="'.$this->FilterByGenreURL.'?gcode='.$this->GCode.'">'.$this->GName.'</a></td>
                  </tr>
                  <tr>
                    <td>Original Release</td>
                    <td>'.$this->ORelease.'</td>
                  </tr>
                  <tr>
                    <td>Translated Version Release</td>
                    <td>'.$this->BRelease.'</td>
                  </tr>
                  <tr>
                    <td>Word Count</td>
                    <td>'.$this->WCount.'</td>
                  </tr>
                  <tr>
                    <td>Update</td>
                    <td>'.$this->BUpdate.'</td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td><p>'.$this->BDesc.'</p></td>
                  </tr>
                </table>';
    }
}

class BookLink {
    public $URL = '-';
    public $LType = '-';

    public function toHTMLTableRow(){
        return '<tr>
                    <td>'.$this->LType.'</td>
                    <td><a href="'.$this->URL.'" target="_blank">'.$this->URL.'</a></td>
                </tr>';
    }
}


class AuthorDetail {
    public $AID = '-';
    public $AName = '-';
    public $LCode = 'eng';
    public $ADesc = '-';

    private $BookDetailsURL = 'placeholder.php';
    private $AuthorDetailsURL = 'placeholder.php';
    private $FilterByGenreURL = 'placeholder.php';

    public function getDetailsInOtherLanguageVersion($LCode){
        return $this->AuthorDetailsURL.'?bid='.$this->AID.'&lcode='.$LCode;
    }

    public function toHTMLDivision(){
        return  '<h2>'.$this->AName.'</h2>
                <p>'.$this->ADesc.'</p>';
    }
}

class Comment {
    public $timeStamp = '-';
    public $Content = '-';

    public function toHTMLTableRow(){
        return '<tr>
                    <td><blockquote>'.$this->Content.'</blockquote><br>'.$this->timeStamp.'</td>
                </tr>';
    }
}

?>
