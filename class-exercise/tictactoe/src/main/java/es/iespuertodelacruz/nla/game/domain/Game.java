package es.iespuertodelacruz.nla.game.domain;


import es.iespuertodelacruz.nla.user.domain.User;

import java.util.Date;

public class Game {
    private int Id;
    private User player1;
    private User player2;

    /**
     * Default constructor of the class
     */
    public Game() {
    }

    public Game(User player1, User player2) {
        this.player1 = player1;
        this.player2 = player2;
    }

    public Game(String id, String player1, String player2) {

    }


}
