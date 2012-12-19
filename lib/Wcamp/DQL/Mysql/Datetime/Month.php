<?php

namespace Wcamp\DQL\Mysql\Datetime;

use Doctrine\ORM\Query\Lexer; 
use Doctrine\ORM\Query\AST\Functions\FunctionNode; 

class Month extends FunctionNode
{
    public $dateTime; 

    public function parse(\Doctrine\ORM\Query\Parser $parser) 
    { 
        $parser->match(Lexer::T_IDENTIFIER); 
        $parser->match(Lexer::T_OPEN_PARENTHESIS); 
        $this->dateTime = $parser->ArithmeticPrimary();     
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); 
    } 

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) 
    { 
        return 'MONTH(' . 
            $this->dateTime->dispatch($sqlWalker) . 
         ')';
    } 
}
