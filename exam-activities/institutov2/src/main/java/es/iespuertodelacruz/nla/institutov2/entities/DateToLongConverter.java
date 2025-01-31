package es.iespuertodelacruz.nla.institutov2.entities;

import jakarta.persistence.AttributeConverter;

import java.util.Date;
/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

public class DateToLongConverter implements AttributeConverter<Date, Long> {
    @Override
    public Long convertToDatabaseColumn(Date attribute) {
        return (attribute == null) ? null : attribute.getTime();
    }

    @Override
    public Date convertToEntityAttribute(Long dbData) {
        return (dbData == null) ? null : new Date(dbData);
    }
}
