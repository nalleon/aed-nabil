package es.iespuertodelacruz.nla.user.domain;


import es.iespuertodelacruz.nla.shared.utils.DateToLongConverter;
import jakarta.persistence.*;

import java.util.Date;

public class User {
    private int Id;
    private String name;

    private String password;

    private String email;

    private String role;

    private int verified;

    private String verificationToken;

    private Date creationDate;

    /**
     * Default copnstructor of the class
     */
    public User() {
    }

    /**
     * Constructor of the class
     * @param name of the user
     * @param password of the user
     * @param email of the user
     */
    public User(String name, String password, String email) {
        this.name = name;
        this.password = password;
        this.email = email;
    }

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
