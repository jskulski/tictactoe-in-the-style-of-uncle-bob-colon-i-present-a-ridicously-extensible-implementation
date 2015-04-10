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
 * And so on with different front pages but all the same core
 * Different datastores
 
The goal is READABLE code. The goal is REUSABLE code. This is code golf, 
but for readable code.

### Pushing State to one place

Reading about Haskell lately and interested in FP (but wholly ignorant of it) lately,
interested in how side effects are handled. Want to try building this as stateless as possible.

Also, wtf are monads man.

### What is Open/Closed anyway? 

Can I make a common core to be able to plugin a Battleship rule set into a TicTacToe game?
Given that they are both 

    game(move, state) -> new state 

get move, check board, compute new state sort of loops. It should be possible.

## Notes

### Log 

Decided to keep log of my monologue while building. Created readme.

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
