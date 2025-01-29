package es.iespuertodelacruz.nla.institutov2.utils;

public class ApiResponse <T> {
    /**
     * Properties
     */
    private int status;
    private String message;
    private T data;

    /**
     * Constructor completo de la clase
     * @param status de la peticion a la api
     * @param message de la peticion a la api
     * @param data de la peticion a la api
     */
    public ApiResponse(int status, String message, T data) {
        this.status = status;
        this.message = message;
        this.data = data;
    }

    /**
     * Getters y setters
     */
    public int getStatus() { return status; }
    public void setStatus(int status) { this.status = status; }

    public String getMessage() { return message; }
    public void setMessage(String message) { this.message = message; }

    public T getData() { return data; }
    public void setData(T data) { this.data = data; }
}
