<?php
/*
    This is the class declaration head file for information display.
    Quary classes not included.

    Author: Phoenix
    Version: 0612.2016

    Classes Index:
        - SearchResult: Represent a single row in the search results
        - BookDetail: Represent a book with all information needed for a Book Detail Page, EXCEPT LINKS AND COMMENTS.
        - BookLink: Represent a single row of the links for the book.
        - AuthorDetail: Represent an author with all information needed for an Author Detail Page, EXCEPT COMMENTS.
        - Commnet: Represent a single comment for a book or an author.
     - The Dummy* classes are all subclasses to the classes above, used for no result case return.
*/
$BookDetailsURL = 'bookInfo.php';
$AuthorDetailsURL = 'authorInfo.php';

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
    public $GLink = '-';


    public function toHTMLTableRow(){
        return '<tr>
                    <td><a href="'.$GLOBALS['BookDetailsURL'].'?bid='.$this->BID.'&lcode='.$this->LCode.'">'.$this->BName.'</a></td>
                    <td><a href="'.$GLOBALS['AuthorDetailsURL'].'?aid='.$this->AID.'&lcode='.$this->LCode.'">'.$this->AName.'</a></td>
                    <td><a href="'.$this->GLink.'">'.$this->GName.'</a></td>
                    <td>'.$this->BRelease.'</td>
                    <td>'.$this->BUpdate.'</td>
                </tr>';
    }
}

// This class is for the case there is no result found.
class DummySR extends SearchResult{
    public function toHTMLTableRow(){
        return '<tr>
                    <td colspan = "42">NO MATCH!</td>
                </tr>';
    }
}

class BookShowcase extends SearchResult {
    public $Clicks = 0;
    public $Favs = 0;

    public function toHTMLTableRow(){
        return '<tr>
                    <td><a href="'.$GLOBALS['BookDetailsURL'].'?bid='.$this->BID.'&lcode='.$this->LCode.'">'.$this->BName.'</a></td>
                    <td><a href="'.$GLOBALS['AuthorDetailsURL'].'?aid='.$this->AID.'&lcode='.$this->LCode.'">'.$this->AName.'</a></td>
                    <td><a href="'.$this->GLink.'">'.$this->GName.'</a></td>
                    <td>'.$this->BRelease.'</td>
                    <td>'.$this->BUpdate.'</td>
                    <td>'.$this->Clicks.'</td>
                    <td>'.$this->Favs.'</td>
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
    public $GLink = '-';

    public function getDetailsInOtherLanguageVersion($LCode){
        return $GLOBALS['BookDetailsURL'].'?bid='.$this->BID.'&lcode='.$LCode;
    }

    public function toHTMLDivision(){
        return  '<h2>'.$this->BName.'</h2>
                <table id="details_table">
                  <tr>
                    <td>Author</td>
                    <td><a href="'.$GLOBALS['AuthorDetailsURL'].'?aid='.$this->AID.'&lcode='.$this->LCode.'">'.$this->AName.'</a></td>
                  </tr>
                  <tr>
                    <td>Genre</td>
                    <td><a href="'.$this->GLink.'">'.$this->GName.'</a></td>
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

// This class is for the case there is no result found.
class DummyBD extends BookDetail{
    public function toHTMLDivision(){
        return  '<h2>404. Ops, No such bookï¼?/h2>';
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

// This class is for the case there is no result found.
class DummyBL extends BookLink{
    public function toHTMLTableRow(){
        return '<tr>
                    <td colspan = "42">NO LINK FOR THIS VERSION YET!</td>
                </tr>';
    }
}

class AuthorDetail {
    public $AID = '-';
    public $AName = '-';
    public $LCode = 'eng';
    public $ADesc = '-';
    public $Favs = 0;

    public function getDetailsInOtherLanguageVersion($LCode){
        return $GLOBALS['AuthorDetailsURL'].'?aid='.$this->AID.'&lcode='.$LCode;
    }

    public function toHTMLDivision(){
        return  '<h2>'.$this->AName.'</h2>
                <p>'.$this->ADesc.'</p>';
    }

    public function toHTMLTableRow(){
        return '<tr>
                    <td><a href="'.$GLOBALS['AuthorDetailsURL'].'?aid='.$this->AID.'&lcode='.$this->LCode.'">'.$this->AName.'</a></td>
                    <td>'.$this->Favs.'</td>
                </tr>';
    }
}

// This class is for the case there is no result found.
class DummyAD extends AuthorDetail{
    public function toHTMLDivision(){
        return  '<h2>404. Ops, no such authorï¼?/h2>';
    }
}


class Comment {
    public $TStamp = '-';
    public $Content = '-';

    public function toHTMLTableRow(){
        return '<tr>
                    <td><blockquote>'.$this->Content.'</blockquote>'.$this->TStamp.'</td>
                </tr>';
    }
}
// This class is for the case there is no result found.
class DummyCMT extends Comment{
    public function toHTMLTableRow(){
        return '<tr>
                    <td colspan = "42"> - No commnet yet.</td>
                </tr>';
    }
}



class FavBook {
    public $BID = '-';
    public $BName = '-';
    public $AID = '-';
    public $AName = '-';
    public $AddedAt = '-';
    public $LCode = '-';

    public function toHTMLTableRow(){
        return '<tr>
                    <td><a href="'.$GLOBALS['BookDetailsURL'].'?bid='.$this->BID.'&lcode='.$this->LCode.'">'.$this->BName.'</a></td>
                    <td><a href="'.$GLOBALS['AuthorDetailsURL'].'?aid='.$this->AID.'&lcode='.$this->LCode.'">'.$this->AName.'</a></td>
                    <td>'.$this->AddedAt.'</td>
                </tr>';
    }
}


class FavAuthor {
    public $AID = '-';
    public $AName = '-';
    public $AddedAt = '-';
    public $LCode = '-';

    public function toHTMLTableRow(){
        return '<tr>
                    <td><a href="'.$GLOBALS['AuthorDetailsURL'].'?aid='.$this->AID.'&lcode='.$this->LCode.'">'.$this->AName.'</a></td>
                    <td>'.$this->AddedAt.'</td>
                </tr>';
    }
}

?>
