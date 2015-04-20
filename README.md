#TicTacToe

## Purpose

This repository is serving as an exploration for a couple recent interests of mine.

### Building a Core App

I want a simple example to illustrate the idea of putting all your business rules in 
one application. I wanted a simple playground to try to do this.

In this repo, the business value is allowing people to play TicTacToe. Over time I'll be
adding requirements/changes and see how the code can adapt to them (hamfistedly simulating
the business world):

 * Support all (m,n,k-games) (4x4x4 TicTacToe)
 * Battleship is roughly the same thing
 * We need a CLI!
 * No! We need a GUI! (might skip cause...php)
 * No! We need a webpage!
 * No! We need a single page app!
 * No! It's gotta be react!
 * And so on with different front pages but all the same core
 * Different datastores
 
The goal is readable code. The goal is reusable code. This is code golf, 
but for readable code.

### Pushing State to one place

Reading about Haskell lately and interested in FP (but wholly ignorant of it) lately,
interested in how side effects are handled. Want to try building this as stateless as possible.

Trying to think of Tic Tac Toe, Battleship, or snake as the function 

    game(move, state) -> new state 
    
It's actually got me excited to see if this can translate to real business cases. 
Is it effective to think of sites like Amazon as collections of functions?

Also, wtf are monads man.

### What is Open/Closed anyway? 

Can I make a common core to be able to plugin a Battleship rule set into a TicTacToe game?
Given that they are both 

    game(move, state) -> new state 

get move, check board, compute new state sort of loops. It should be possible.

### Use Boring Technology

Sort of an afterthought, but I chose to do this (or most of this in php). I work in PHP at
the moment so it was at hand ([easy](http://www.infoq.com/presentations/Simple-Made-Easy)).

I want to learn new languages, but for this project, I wanted that not to be a hurdle. But
it hurts. It really, really hurts. PHP is boring. But 
[this blog post](http://mcfunley.com/choose-boring-technology) has nice points too.

## Notes

### Log 

Decided to keep log of my monologue while building. Created readme.

### List of Moves vs Array of Arrays

A year ago, if I was building this, among the first lines would be 

    <?php
    $board = array(
        array(null, null, null),
        array(null, null, null),
        array(null, null, null)
    );
    
I've been really trying to write my tests first lately and see where it takes me without
design decisions. I'll say I was pleasantly surprised when I ended with a core concept of
a list of moves instead.

So instead of the stateful

    public function addMove($x, $y, $player) { 
        $this->board[$x][$y] = $player;
    }
    
I went with 
    
    public function addMove($x, $y, $player, $moveHistory) { 
        return $this->appendArray(array($x, $y, $player), $moveHistory);
    }

where appendArray creates a new array. And I did encapsulate $x, $y, $player in a 
Move concept. I never got around (so far) creating a MoveHistory (array of $moves).
I tried to introduce it once (since the moveFilterer and Referee have 'utility' functions
that are more tied to MoveHistories than their owners- like getLastMove()) but it was
very difficult to change stuff like

    /**
     * @param Move[] $moveHistory
     */
    public function dependantOnMoveArray(array $moveHistory) { ... }

to using an object. There are many, many places like this. I tried twice so far and have
gotten lost both times. The benefit is nice, but not needed and I decided to work on other
things.

Regardless, working always with a list of moves is a very nice way to think about the 
problem and led me to the MoveFilterer, which I'm proud of. It's a nice way to work and
reminds me of declarative SQL/LINQ.


### Decorator pattern

Last night starting the battleship ruleset, I got stuck playing with coordinates
which will be a base concept in this thing. I felt like

    $game->makeMove('A4');

is worse than the API for TicTacToe

    $game->makeMove(-1, 1);
    
which it isn't. But I've been uncomfortable with it in TicTacToe. 
It also seemed annoying to say

    $game->makeMove(new Coordinate('A4'));
    
than 

    $game->makeMove('A4');
    
so I created was up late and created a decorator that looks like 

    class Game { 
        /**
         * @ConvertArgumentToCoordinate(true, false)
         */
        public function someFunction($arg1, $arg2) { 
        }
    }
    
and I hate it. 

It was fun to build, reflection is fun. But it makes the API less discoverable. 
How does a developer know that they should use this? How does a dev know to use 'A4'
instead? What is a good API for this, anyway?

    $game->makeMove(Moves::A4);  
    $game->makeMove(Moves::A4()); 
    $game->makeMove(AlliesPlayer::MoveA4());
    $game->makeMove(Moves::AlliesPlayer->A4());

I think I'll stick with the decorator because I'm not pulled in any other direction.
But it was absolutely a distraction and a sidetrack based on fearing the future. But
let's ride it because I wasn't happy with using primitives in TicTacToe-land.

### Drowning a bit

Ditched the decorator, too clever. Settled on this verbose but workable syntax:

     $gameState = $gameEngine->makeMove(
         PlayerMove::forAllies(Coordinate::at($move)),
         $gameState
     );
     
It's verbose but makes sense to me. I comfort myself thinking that it should only
be in one place in the front end consumer. Anyway, kinda of drowning in details,
the design exploded quickly and uses very little of the tic tac toe game. 

Well if the design is too big, that will shake out, between the tests and usage. 
I will trello a note to go through and delete unused classes.

At some point I will have enough duplication that I can start to refactor the design between
the two games. Trying to use it has been slowing me down. I don't think I have enough code
to do it right now.

Dark times.

### Pivoting back

I've gotten fairly stuck on abstracting an engine to use for Battleship. I'm also focused
to use this as an example for a talk given at work about 'Core Apps'. I'll switch back to 
doing the frontend and datastores, putting Battleship on hold. I think that it more 
illustrative about the concepts than another game. And I'll switch back to Battleship, 
or maybe something like the hyper-tictactoe game or 
SOS (http://en.wikipedia.org/wiki/SOS_(game)).


