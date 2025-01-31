package es.iespuertodelacruz.nla.institutov2.entities;

import java.io.Serializable;

import com.fasterxml.jackson.annotation.JsonIgnore;
import jakarta.persistence.*;
import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

/**
 * The persistent class for the asignaturas database table.
 * 
 */
@Entity
@Table(name="asignaturas")
@NamedQuery(name="Asignatura.findAll", query="SELECT a FROM Asignatura a")
public class Asignatura implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(unique=true, nullable=false)
	private int id;

	@Column(length=50)
	private String curso;

	@Column(length=50)
	private String nombre;

	//bi-directional many-to-many association to Matricula
	@ManyToMany  //(fetch=FetchType.LAZY)
	@JsonIgnore
	@JoinTable(
		name="asignaturas_matriculas"
		, joinColumns={
			  @JoinColumn(name="idasignatura")
			}
		, inverseJoinColumns={
			  @JoinColumn(name="idmatricula")
			}
		)
	private List<Matricula> matriculas;




	public Asignatura() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getCurso() {
		return this.curso;
	}

	public void setCurso(String curso) {
		this.curso = curso;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public List<Matricula> getMatriculas() {
		return this.matriculas;
	}

	public void setMatriculas(List<Matricula> matriculas) {
		this.matriculas = matriculas;
	}

}