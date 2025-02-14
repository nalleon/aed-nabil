package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.document;

import es.iespuertodelacruz.nla.shared.utils.DateToLongConverter;
import jakarta.persistence.Column;
import jakarta.persistence.Convert;
import jakarta.persistence.Id;
import org.springframework.data.mongodb.core.mapping.Document;

import java.util.Date;
import java.util.Objects;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Document(collection = "usuarios")
public class UserDocument {

    @Id
    private String Id;


    @Column(unique = true, nullable=false, length=45)
    private String name;

    @Column(nullable=false, length=200)
    private String password;

    @Column(unique = true, nullable=false, length=100)
    private String email;

    @Column(nullable=false, length=45)
    private String role;

    private int verified;

    @Column(length=255)
    private String verificationToken;

    @Column(nullable=false, length=45)
    @Convert(converter = DateToLongConverter.class)
    private Date creationDate;


    /**
     * Getters and setters
     */
    public String getId() {
        return Id;
    }

    public void setId(String id) {
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

    /**
     * Tostring and equals
     */
    @Override
    public String toString() {
        return "UserDocument{" +
                "Id='" + Id + '\'' +
                ", name='" + name + '\'' +
                ", password='" + password + '\'' +
                ", email='" + email + '\'' +
                ", role='" + role + '\'' +
                ", verified=" + verified +
                ", verificationToken='" + verificationToken + '\'' +
                ", creationDate=" + creationDate +
                '}';
    }

    @Override
    public boolean equals(Object o) {
        if (o == null || getClass() != o.getClass()) return false;
        UserDocument that = (UserDocument) o;
        return Objects.equals(Id, that.Id) && Objects.equals(name, that.name) && Objects.equals(email, that.email);
    }

    @Override
    public int hashCode() {
        return Objects.hash(Id, name, email);
    }
}
