package es.iespuertodelacruz.nla.institutov2.entities;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.Date;
import java.util.List;


/**
 * The persistent class for the alumnos database table.
 *
 */
@Entity
@Table(name="alumnosconfoto")
@NamedQuery(name="AlumnoFoto.findAll", query="SELECT a FROM AlumnoFoto a")
public class AlumnoFoto implements Serializable {
    private static final long serialVersionUID = 1L;

    @Id
    @Column(unique=true, nullable=false, length=20)
    private String dni;

    @Column(length=50)
    private String apellidos;

    @Convert(converter = DateToLongConverter.class)
    private Date fechanacimiento;

    @Column(length=50)
    private String nombre;

    @OneToMany(mappedBy="alumno")
    private List<Matricula> matriculas;

    @Column(length=255)
    private String path_foto;

    public AlumnoFoto() {}

    public String getDni() {
        return this.dni;
    }

    public void setDni(String dni) {
        this.dni = dni;
    }

    public String getApellidos() {
        return this.apellidos;
    }

    public void setApellidos(String apellidos) {
        this.apellidos = apellidos;
    }

    public Date getFechanacimiento() {
        return this.fechanacimiento;
    }

    public void setFechanacimiento(Date fechanacimiento) {
        this.fechanacimiento = fechanacimiento;
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

    public String getPath_foto() {
        return path_foto;
    }

    public void setPath_foto(String path_foto) {
        this.path_foto = path_foto;
    }
}