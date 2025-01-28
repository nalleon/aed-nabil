package es.iespuertodelacruz.tictactoe.domain.model;

import es.iespuertodelacruz.tictactoe.domain.Player;
import es.iespuertodelacruz.tictactoe.domain.enums.Status;

import java.util.Random;

public class Game {

    private char[] playerSymbols = {'x', 'o'};
    private Player player1;
    private Player player2;
    private Player currentTurn;
    private Status gameStatus;
    private String winner;
    private char[][] board = {{' ', ' ', ' '},{' ', ' ', ' '},{' ', ' ', ' '}};

    public Game(Player player1, Player player2) {
        this.player1 = player1;
        this.player2 = player2;
        this.currentTurn = chooseFirstTurn();
        this.gameStatus = Status.PLAYING;
        this.winner = null;
    }

    private Player chooseFirstTurn (){
        Random random = new Random();

        int aux = random.nextInt(0,1);

        if(aux == 0){
            return this.player1;
        }

        return this.player2;
    }

    private String checkWin(){

        return "";
    }

    private Player hasLine(Player player, int i, int j) {

        return player1;
    }

}
