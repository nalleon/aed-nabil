package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.shared.utils.DateToLongConverter;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.UserEntity;
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

    @ManyToOne
    @JoinColumn(name="jugador1")
    private UserEntity player1;

    @JoinColumn(name="jugador2")
    @ManyToOne
    private UserEntity player2;

    @Column(name = "board")
    private char[][] board;

    @Column(name = "finalizado")
    private boolean finished;

    public GameEntity() {}

    /**
     * Getters and setters
     */
    public int getId() {
        return Id;
    }

    public void setId(int id) {
        Id = id;
    }

    public UserEntity getPlayer1() {
        return player1;
    }

    public void setPlayer1(UserEntity player1) {
        this.player1 = player1;
    }

    public UserEntity getPlayer2() {
        return player2;
    }

    public void setPlayer2(UserEntity player2) {
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
