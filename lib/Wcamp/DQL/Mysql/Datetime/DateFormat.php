<?php

namespace Wcamp\DQL\Mysql\Datetime;

use Doctrine\ORM\Query\Lexer; 
use Doctrine\ORM\Query\AST\Functions\FunctionNode; 

class DateFormat extends FunctionNode
{
    public $dateTime; 
    public $dateTimeFormat;

    public function parse(\Doctrine\ORM\Query\Parser $parser) 
    { 
        $parser->match(Lexer::T_IDENTIFIER); 
        $parser->match(Lexer::T_OPEN_PARENTHESIS); 
        $this->dateTime = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->dateTimeFormat = $parser->StringExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); 
    } 

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) 
    { 
        return 'DATE_FORMAT(' . 
            $this->dateTime->dispatch($sqlWalker) . " , " .
            $this->dateTimeFormat->dispatch($sqlWalker) .
         ')';
    } 
}
