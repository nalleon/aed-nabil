package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary;

import es.iespuertodelacruz.nla.shared.utils.DateToLongConverter;
import jakarta.persistence.Entity;
import jakarta.persistence.Id;


import jakarta.persistence.*;

import java.util.Date;
/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Entity
@Table(name="usuarios")
@NamedQuery(name="UserEntity.findAll", query="SELECT u FROM UserEntity u")
public class UserEntity {
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    @Column(unique=true, nullable=false)
    private int Id;


    @Column(unique = true, nullable=false, length=45)
    private String nombre;

    @Column(nullable=false, length=200)
    private String password;

    @Column(unique = true, nullable=false, length=100)
    private String correo;

    @Column(nullable=false, length=45)
    private String rol;

    private int verificado;

    @Column(length=255)
    private String token_verificacion;

    @Column(nullable=false, length=45)
    @Convert(converter = DateToLongConverter.class)
    private Date fecha_creacion;


    /**
     * Getters and setters
     */
    public int getId() {
        return Id;
    }

    public void setId(int id) {
        Id = id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getCorreo() {
        return correo;
    }

    public void setCorreo(String correo) {
        this.correo = correo;
    }

    public String getRol() {
        return rol;
    }

    public void setRol(String rol) {
        this.rol = rol;
    }

    public int getVerificado() {
        return verificado;
    }

    public void setVerificado(int verificado) {
        this.verificado = verificado;
    }

    public String getToken_verificacion() {
        return token_verificacion;
    }

    public void setToken_verificacion(String token_verificacion) {
        this.token_verificacion = token_verificacion;
    }

    public Date getFecha_creacion() {
        return fecha_creacion;
    }

    public void setFecha_creacion(Date fecha_creacion) {
        this.fecha_creacion = fecha_creacion;
    }
}
