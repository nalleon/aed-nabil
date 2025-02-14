package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.shared.utils.DateToLongConverter;
import jakarta.persistence.*;

import java.util.Date;
/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Entity
@Table(name="usuarios")
@NamedQuery(name="UserEntity.findAll", query="SELECT u FROM UserEntity u")
public class GameEntity {
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    @Column(unique=true, nullable=false)
    private int Id;


    @Column(unique = true, nullable=false, length=45, name = "nombre")
    private String name;

    @Column(nullable=false, length=200)
    private String password;

    @Column(unique = true, nullable=false, length=100, name = "correo")
    private String email;

    @Column(nullable=false, length=45, name = "rol")
    private String role;

    @Column(name = "verificado")
    private int verified;

    @Column(length=255, name = "token_verificacion")
    private String verificationToken;

    @Column(nullable=false, length=45, name = "fecha_creacion")
    @Convert(converter = DateToLongConverter.class)
    private Date creationDate;


    /**
     * Getters and setters
     */
    public int getId() {
        return Id;
    }

    public void setId(int id) {
        Id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }

    public int getVerified() {
        return verified;
    }

    public void setVerified(int verified) {
        this.verified = verified;
    }

    public String getVerificationToken() {
        return verificationToken;
    }

    public void setVerificationToken(String verificationToken) {
        this.verificationToken = verificationToken;
    }

    public Date getCreationDate() {
        return creationDate;
    }

    public void setCreationDate(Date creationDate) {
        this.creationDate = creationDate;
    }
}
