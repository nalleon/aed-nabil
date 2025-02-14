package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.shared.utils.DateToLongConverter;
import es.iespuertodelacruz.nla.user.domain.User;
import jakarta.persistence.*;

import java.util.Date;
/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Entity
@Table(name="partidas")
@NamedQuery(name="GameEntity.findAll", query="SELECT u FROM GameEntity u")
public class GameEntity {
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    @Column(unique=true, nullable=false)
    private int Id;
    private User player1;
    private User player2;
    private char[][] board;
    private boolean finished;

    public GameEntity() {
    }



    /**
     * Getters and setters
     */
    public int getId() {
        return Id;
    }

    public void setId(int id) {
        Id = id;
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
}
