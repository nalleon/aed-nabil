package es.iespuertodelacruz.nla.game.domain;


import es.iespuertodelacruz.nla.user.domain.User;

import java.util.Arrays;
import java.util.Objects;

public class Game {
    private int id;
    private User player1;
    private User player2;
    private char[][] board;
    private boolean finished;
    /**
     * Default constructor of the class
     */
    public Game() {
    }

    public Game(User player1, User player2, char[][] board, boolean finished) {
        this.player1 = player1;
        this.player2 = player2;
        this.board = board;
        this.finished = finished;
    }

    /**
     * Getters and setters
     * @return
     */
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public User getPlayer1() {
        return player1;
    }

    public void setPlayer1(User player1) {
        this.player1 = player1;
    }

    public User getPlayer2() {
        return player2;
    }

    public void setPlayer2(User player2) {
        this.player2 = player2;
    }

    public char[][] getBoard() {
        return board;
    }

    public void setBoard(char[][] board) {
        this.board = board;
    }

    public boolean isFinished() {
        return finished;
    }

    public void setFinished(boolean finished) {
        this.finished = finished;
    }

    @Override
    public String toString() {
        return "Game{" +
                "Id=" + id +
                ", player1=" + player1 +
                ", player2=" + player2 +
                ", board=" + Arrays.toString(board) +
                ", finished=" + finished +
                '}';
    }

    @Override
    public boolean equals(Object o) {
        if (o == null || getClass() != o.getClass()) return false;
        Game game = (Game) o;
        return id == game.id;
    }

    @Override
    public int hashCode() {
        return Objects.hashCode(id);
    }

    //TODO: add check win, check positions


    public boolean checkDiagonal (char value) {
        if(board[0][0] == value && board[1][1] == value && board[2][2] == value){
            return true;
        } else if(board[2][0] == value && board[1][1] == value && board[0][2]== value){
            return true;
        }
        return false;
    }



    public boolean checkVertical (int posX, int posY, char value) {
        return switch (posY) {
            case 0 -> board[posX][posY] == value && board[posX][posY + 1] == value && board[posX][posY + 2] == value;
            case 1 -> board[posX][posY] == value && board[posX][posY + 1] == value && board[posX][posY - 1] == value;
            case 2 -> board[posX][posY] == value && board[posX][posY - 1] == value && board[posX][posY - 2] == value;
            default -> false;
        };

    }


    public boolean checkHorizontal (int posX, int posY, char value) {
        return switch (posX) {
            case 0 -> board[posX][posY] == value && board[posX + 1][posY] == value && board[posX + 2][posY] == value;
            case 1 -> board[posX][posY] == value && board[posX + 1][posY] == value && board[posX - 1][posY] == value;
            case 2 -> board[posX][posY] == value && board[posX - 1][posY] == value && board[posX - 2][posY] == value;
            default -> false;
        };
    }

}
