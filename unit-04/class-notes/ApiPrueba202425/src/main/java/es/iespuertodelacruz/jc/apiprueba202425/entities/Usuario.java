package es.iespuertodelacruz.jc.apiprueba202425.entities;

import java.io.Serializable;
import jakarta.persistence.*;
import java.math.BigInteger;


/**
 * The persistent class for the usuarios database table.
 * 
 */
@Entity
@Table(name="usuarios")
@NamedQuery(name="Usuario.findAll", query="SELECT u FROM Usuario u")
public class Usuario implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(unique=true, nullable=false)
	private int id;

	@Column(nullable=false, length=100)
	private String correo;

	@Column(name="fecha_creacion")
	private Long fechaCreacion;

	@Column(nullable=false, length=45)
	private String nombre;

	@Column(nullable=false, length=200)
	private String password;

	@Column(nullable=false, length=45)
	private String rol;

	@Column(name="token_verificacion", length=255)
	private String tokenVerificacion;

	private int verificado;

	public Usuario() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getCorreo() {
		return this.correo;
	}

	public void setCorreo(String correo) {
		this.correo = correo;
	}

	public Long getFechaCreacion() {
		return this.fechaCreacion;
	}

	public void setFechaCreacion(Long fechaCreacion) {
		this.fechaCreacion = fechaCreacion;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getPassword() {
		return this.password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getRol() {
		return this.rol;
	}

	public void setRol(String rol) {
		this.rol = rol;
	}

	public String getTokenVerificacion() {
		return this.tokenVerificacion;
	}

	public void setTokenVerificacion(String tokenVerificacion) {
		this.tokenVerificacion = tokenVerificacion;
	}

	public int getVerificado() {
		return this.verificado;
	}

	public void setVerificado(int verificado) {
		this.verificado = verificado;
	}

}