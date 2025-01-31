package es.iespuertodelacruz.tictactoe.domain.model;

import es.iespuertodelacruz.tictactoe.domain.Player;
import es.iespuertodelacruz.tictactoe.domain.enums.Status;

import java.util.*;

public class Game {
    private Player player1;
    private Player player2;
    private Player currentTurn;
    private Status gameStatus;
    private String winner;
    private String[][] board = {{" ", " ", " "},{" ", " ", " "},{" ", " ", " "}};
    private List<Integer> allowedPositions = new ArrayList<>(Arrays.asList(0,1,-1));

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

    private void changeTurn(){
        if (currentTurn.equals(player1)){
            currentTurn = player2;
        } else {
            currentTurn = player1;
        }
    }
    
    private String checkWin(){

        return "";
    }
    
    private Player hasLine(Player player, int x, int y) {
        for (int i=0; i< board.length; i++){
            if(board[i][0].equals(player.symbol()) && board[i][1].equals(player.symbol()) &&
                    board[i][2].equals(player.symbol())){
                return player;
            }

            if(board[0][i].equals(player.symbol()) && board[1][i].equals(player.symbol()) &&
                    board[2][i].equals(player.symbol())){
                return player;
            }


            if(board[i][0].equals(player.symbol()) && board[0][i].equals(player.symbol()) &&
                    board[2][i].equals(player.symbol())){
                return player;
            }
        }
        
        return null;
    }

}
