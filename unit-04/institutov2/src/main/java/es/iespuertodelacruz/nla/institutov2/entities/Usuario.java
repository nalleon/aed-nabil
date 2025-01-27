package es.iespuertodelacruz.nla.institutov2.entities;

import jakarta.persistence.*;

@Entity
@Table(name="usuarios")
@NamedQuery(name="Usuario.findAll", query="SELECT u FROM Usuarios u")
public class Usuario {
    @Id
    @Column(unique=true, nullable=false, length=20)
    private String dni;

    @Column(unique = true, nullable=false, length=45)
    private String nombre;

    @Column(nullable=false, length=200)
    private String password;

    @Column(unique = true, nullable=false, length=100)
    private String correo;

    @Column(nullable=false, length=45)
    private String rol;

    private boolean verificado;

    @Column(length=255)
    private String token_verificacion;

    @Column(nullable=false, length=45)
    private String fecha_creacion;

    public String getDni() {
        return dni;
    }

    public void setDni(String dni) {
        this.dni = dni;
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

    public boolean isVerificado() {
        return verificado;
    }

    public void setVerificado(boolean verificado) {
        this.verificado = verificado;
    }

    public String getToken_verificacion() {
        return token_verificacion;
    }

    public void setToken_verificacion(String token_verificacion) {
        this.token_verificacion = token_verificacion;
    }

    public String getFecha_creacion() {
        return fecha_creacion;
    }

    public void setFecha_creacion(String fecha_creacion) {
        this.fecha_creacion = fecha_creacion;
    }
}
