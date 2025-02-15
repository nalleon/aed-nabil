package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities.UserEntity;
import jakarta.persistence.*;

import java.util.Objects;

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
    private int id;

    @ManyToOne
    @JoinColumn(name="jugador1")
    private UserEntity player1;

    @JoinColumn(name="jugador2")
    @ManyToOne
    private UserEntity player2;

    @Column(name = "board")
    private String board;

    @Column(name = "finalizado")
    private boolean finished;

    public GameEntity() {}

    /**
     * Getters and setters
     */
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
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

    public String getBoard() {
        return board;
    }

    public void setBoard(String board) {
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
        return "GameEntity{" +
                "Id=" + id +
                ", player1=" + player1 +
                ", player2=" + player2 +
                ", board='" + board + '\'' +
                ", finished=" + finished +
                '}';
    }

    @Override
    public boolean equals(Object o) {
        if (o == null || getClass() != o.getClass()) return false;
        GameEntity that = (GameEntity) o;
        return id == that.id;
    }

    @Override
    public int hashCode() {
        return Objects.hashCode(id);
    }
}
