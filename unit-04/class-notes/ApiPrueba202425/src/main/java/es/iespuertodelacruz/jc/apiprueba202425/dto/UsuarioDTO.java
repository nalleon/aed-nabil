package es.iespuertodelacruz.jc.apiprueba202425.dto;

import java.io.Serializable;


import jakarta.persistence.*;
import java.math.BigInteger;
import java.util.Date;
import com.fasterxml.jackson.annotation.JsonIgnore;

public record UsuarioDTO(
        int id,
        String correo,
        Date fechaCreacion,
        String nombre,
        String password,
        String rol
) implements Serializable {
    
/*
    @JsonIgnore
    @Override
    public String password() {
        return password;
    }
    */
}


/*

public class UsuarioDTO implements Serializable {
	private static final long serialVersionUID = 1L;

	
	private int id;

	
	private String correo;

	
	private Date fechaCreacion;

	
	private String nombre;

	
	private String password;

	
	private String rol;

	
	private String tokenVerificacion;

	private int verificado;

	public UsuarioDTO() {
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

	public Date getFechaCreacion() {
		return this.fechaCreacion;
	}

	public void setFechaCreacion(Date fechaCreacion) {
		this.fechaCreacion = fechaCreacion;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	 @JsonIgnore
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
*/


