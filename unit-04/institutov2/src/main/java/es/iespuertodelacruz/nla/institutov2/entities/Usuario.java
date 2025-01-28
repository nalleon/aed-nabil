package es.iespuertodelacruz.nla.institutov2.entities;

import jakarta.persistence.*;

import java.util.Date;

@Entity
@Table(name="usuarios")
@NamedQuery(name="Usuario.findAll", query="SELECT u FROM Usuario u")
public class Usuario {
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    @Column(unique=true, nullable=false)
    private int id;

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

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
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
