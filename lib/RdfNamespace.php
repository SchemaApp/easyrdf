<?php
namespace EasyRdf;

/**
 * EasyRdf
 *
 * LICENSE
 *
 * Copyright (c) 2009-2014 Nicholas J Humfrey.  All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 * 3. The name of the author 'Nicholas J Humfrey" may be used to endorse or
 *    promote products derived from this software without specific prior
 *    written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    EasyRdf
 * @copyright  Copyright (c) 2009-2014 Nicholas J Humfrey
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * A namespace registry and manipulation class.
 *
 * @package    EasyRdf
 * @copyright  Copyright (c) 2009-2014 Nicholas J Humfrey
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
class RdfNamespace
{
    /** Namespace registry
     *
     * List of default namespaces come from:
     *  - http://www.w3.org/2011/rdfa-context/rdfa-1.1
     *
     * With a few extras added.
     *
     */
    private static $initial_namespaces = array(
        'bibo'    => 'http://purl.org/ontology/bibo/',
        'cc'      => 'http://creativecommons.org/ns#',
        'cert'    => 'http://www.w3.org/ns/auth/cert#',
        'ctag'    => 'http://commontag.org/ns#',
        'dc'      => 'http://purl.org/dc/terms/',
        'dc11'    => 'http://purl.org/dc/elements/1.1/',
        'dcat'    => 'http://www.w3.org/ns/dcat#',
        'dcterms' => 'http://purl.org/dc/terms/',
        'doap'    => 'http://usefulinc.com/ns/doap#',
        'exif'    => 'http://www.w3.org/2003/12/exif/ns#',
        'foaf'    => 'http://xmlns.com/foaf/0.1/',
        'ga'      => 'http://schemaapp.com/ontology/googleanalytics#',
        'geo'     => 'http://www.w3.org/2003/01/geo/wgs84_pos#',
        'gist'    => 'http://ontologies.semanticarts.com/gist#',
        'gr'      => 'http://purl.org/goodrelations/v1#',
        'grddl'   => 'http://www.w3.org/2003/g/data-view#',
        'ical'    => 'http://www.w3.org/2002/12/cal/icaltzd#',
        'ma'      => 'http://www.w3.org/ns/ma-ont#',
        'og'      => 'http://ogp.me/ns#',
        'org'     => 'http://www.w3.org/ns/org#',
        'owl'     => 'http://www.w3.org/2002/07/owl#',
        'prov'    => 'http://www.w3.org/ns/prov#',
        'qb'      => 'http://purl.org/linked-data/cube#',
        'rdf'     => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
        'rdfa'    => 'http://www.w3.org/ns/rdfa#',
        'rdfs'    => 'http://www.w3.org/2000/01/rdf-schema#',
        'rev'     => 'http://purl.org/stuff/rev#',
        'rif'     => 'http://www.w3.org/2007/rif#',
        'rr'      => 'http://www.w3.org/ns/r2rml#',
        'rss'     => 'http://purl.org/rss/1.0/',
        'schema'  => 'http://schema.org/',
        'sd'      => 'http://www.w3.org/ns/sparql-service-description#',
        'sh'      => 'http://www.w3.org/ns/shacl#',
        'sioc'    => 'http://rdfs.org/sioc/ns#',
        'skos'    => 'http://www.w3.org/2004/02/skos/core#',
        'skosxl'  => 'http://www.w3.org/2008/05/skos-xl#',
        'sp'      => 'http://spinrdf.org/sp#',
        'synd'    => 'http://purl.org/rss/1.0/modules/syndication/',
        'v'       => 'http://rdf.data-vocabulary.org/#',
        'vcard'   => 'http://www.w3.org/2006/vcard/ns#',
        'void'    => 'http://rdfs.org/ns/void#',
        'webmanager' => 'http://hunchmanifest.com/ontology/webmanager#',
        'wdr'     => 'http://www.w3.org/2007/05/powder#',
        'wdrs'    => 'http://www.w3.org/2007/05/powder-s#',
        'wot'     => 'http://xmlns.com/wot/0.1/',
        'xhv'     => 'http://www.w3.org/1999/xhtml/vocab#',
        'xml'     => 'http://www.w3.org/XML/1998/namespace',
        'xsd'     => 'http://www.w3.org/2001/XMLSchema#',

        // Custom Namespaces
        'aws'     => 'http://schemaapp.com/ontology/aws#',
        'bigcom'  => 'http://schemaapp.com/resources/bigcommerce/',
        'drip'    => 'http://schemaapp.com/ontology/drip/',
        'high'    => 'http://schemaapp.com/ontology/highlight#',
        'hmapp'   => 'http://hunchmanifest.com/ontology/Application#',
        'jsonld'  => 'http://hunchmanifest.com/ontology/json-ld#',
        'legs'    => 'http://schemaapp.com/ontology/eightylegs#',
        'pipedrive' => 'http://schemaapp.com/ontology/pipedrive/',
        'schemamodel' => 'http://schemaapp.com/ontology/schemamodel#',
        'schr'    => 'http://schemaapp.com/resources/admin/',
        'shopify' => 'http://schemaapp.com/ontology/shopify#',
        'stripe'  => 'http://hunchmanifest.com/ontology/stripe#',
        'youtube' => 'http://schemaapp.com/ontology/youtube#',
    );

    private static $namespaces = null;

    private static $default = null;

    /** Counter for numbering anonymous namespaces */
    private static $anonymousNamespaceCount = 0;

    /**
      * Return all the namespaces registered
      *
      * @return array Associative array of all the namespaces.
      */
    public static function namespaces()
    {
        if (self::$namespaces === null) {
            self::resetNamespaces();
        }

        return self::$namespaces;
    }

    /**
     * Resets list of namespaces to the one, which is provided by EasyRDF
     * useful for tests, among other things
     */
    public static function resetNamespaces()
    {
        self::$namespaces = self::$initial_namespaces;
    }

    /**
      * Return a namespace given its prefix.
      *
      * @param string $prefix The namespace prefix (eg 'foaf')
      *
      * @throws \InvalidArgumentException
      * @return string The namespace URI (eg 'http://xmlns.com/foaf/0.1/')
      */
    public static function get($prefix)
    {
        if (!is_string($prefix) or $prefix === null) {
            throw new \InvalidArgumentException(
                "\$prefix should be a string and cannot be null or empty"
            );
        }

        if (preg_match('/\W/', $prefix)) {
            throw new \InvalidArgumentException(
                "\$prefix should only contain alpha-numeric characters"
            );
        }

        $prefix = strtolower($prefix);
        $namespaces = self::namespaces();

        if (array_key_exists($prefix, $namespaces)) {
            return $namespaces[$prefix];
        } else {
            return null;
        }
    }

    /**
      * Register a new namespace.
      *
      * @param string $prefix The namespace prefix (eg 'foaf')
      * @param string $long The namespace URI (eg 'http://xmlns.com/foaf/0.1/')
      *
      * @throws \LogicException
      * @throws \InvalidArgumentException
      */
    public static function set($prefix, $long)
    {
        if (!is_string($prefix) or $prefix === null) {
            throw new \InvalidArgumentException(
                "\$prefix should be a string and cannot be null or empty"
            );
        }

        if ($prefix !== '') {
            // prefix        ::= Name minus ":"                   // see: http://www.w3.org/TR/REC-xml-names/#NT-NCName
            // Name          ::= NameStartChar (NameChar)*        // see: http://www.w3.org/TR/REC-xml/#NT-Name
            // NameStartChar ::= ":" | [A-Z] | "_" | [a-z] | [#xC0-#xD6] | [#xD8-#xF6] | [#xF8-#x2FF] | [#x370-#x37D] |
            //                   [#x37F-#x1FFF] | [#x200C-#x200D] | [#x2070-#x218F] | [#x2C00-#x2FEF] |
            //                   [#x3001-#xD7FF] | [#xF900-#xFDCF] | [#xFDF0-#xFFFD] | [#x10000-#xEFFFF]
            // NameChar      ::= NameStartChar | "-" | "." | [0-9] | #xB7 | [#x0300-#x036F] | [#x203F-#x2040]

            $_name_start_char =
                'A-Z_a-z\xc0-\xD6\xd8-\xf6\xf8-\xff\x{0100}-\x{02ff}\x{0370}-\x{037d}' .
                '\x{037F}-\x{1FFF}\x{200C}-\x{200D}\x{2070}-\x{218F}\x{2C00}-\x{2FEF}\x{3001}-\x{D7FF}' .
                '\x{F900}-\x{FDCF}\x{FDF0}-\x{FFFD}\x{10000}-\x{EFFFF}';

            $_name_char =
                $_name_start_char .
                '\-.0-9\xb7\x{0300}-\x{036f}\x{203f}-\x{2040}';

            $regex = "#^[{$_name_start_char}]{1}[{$_name_char}]{0,}$#u";

            $match_result = preg_match($regex, $prefix);

            if ($match_result === false) {
                throw new \LogicException('regexp error');
            }

            if ($match_result === 0) {
                throw new \InvalidArgumentException(
                    "\$prefix should match RDFXML-QName specification. got: {$prefix}"
                );
            }
        }

        if (!is_string($long) or $long === null or $long === '') {
            throw new \InvalidArgumentException(
                "\$long should be a string and cannot be null or empty"
            );
        }

        $prefix = strtolower($prefix);

        $namespaces = self::namespaces();
        $namespaces[$prefix] = $long;

        self::$namespaces = $namespaces;
    }

    /**
      * Get the default namespace
      *
      * Returns the URI of the default namespace or null
      * if no default namespace is defined.
      *
      * @return string The URI of the default namespace
      */
    public static function getDefault()
    {
        return self::$default;
    }

    /**
      * Set the default namespace
      *
      * Set the default namespace to either a URI or the prefix of
      * an already defined namespace.
      *
      * Example:
      *   EasyRdf\RdfNamespace::setDefault('http://schema.org/');
      *
      * @param string $namespace The URI or prefix of a namespace (eg 'og')
      *
      * @throws \InvalidArgumentException
      */
    public static function setDefault($namespace)
    {
        if (is_null($namespace) or $namespace === '') {
            self::$default = null;
        } elseif (preg_match('/^\w+$/', $namespace)) {
            $namespaces = self::namespaces();

            if (!isset($namespaces[$namespace])) {
                throw new \InvalidArgumentException(
                    "Unable to set default namespace to unknown prefix: $namespace"
                );
            }

            self::$default = $namespaces[$namespace];
        } else {
            self::$default = $namespace;
        }
    }

    /**
      * Delete an existing namespace.
      *
      * @param string $prefix The namespace prefix (eg 'foaf')
      *
      * @throws \InvalidArgumentException
      */
    public static function delete($prefix)
    {
        if (!is_string($prefix) or $prefix === null or $prefix === '') {
            throw new \InvalidArgumentException(
                "\$prefix should be a string and cannot be null or empty"
            );
        }

        $prefix = strtolower($prefix);
        self::namespaces();  // make sure, that self::$namespaces is initialized
        if (isset(self::$namespaces[$prefix])) {
            unset(self::$namespaces[$prefix]);
        }
    }

    /**
      * Delete the anonymous namespaces and reset the counter to 0
      */
    public static function reset()
    {
        while (self::$anonymousNamespaceCount > 0) {
            self::delete('ns'.(self::$anonymousNamespaceCount-1));
            self::$anonymousNamespaceCount--;
        }
    }

    /**
      * Try and breakup a URI into a prefix and local part
      *
      * If $createNamespace is true, and the URI isn't part of an existing
      * namespace, then EasyRdf will attempt to create a new namespace and
      * return the name of the new prefix (for example 'ns0', 'term').
      *
      * If it isn't possible to split the URI, then null will be returned.
      *
      * @param string  $uri The full URI (eg 'http://xmlns.com/foaf/0.1/name')
      * @param bool    $createNamespace If true, a new namespace will be created
      *
      * @throws \InvalidArgumentException
      * @return array  The split URI (eg 'foaf', 'name') or null
      */
    public static function splitUri($uri, $createNamespace = false)
    {
        if ($uri === null or $uri === '') {
            throw new \InvalidArgumentException(
                "\$uri cannot be null or empty"
            );
        }

        if (is_object($uri) and ($uri instanceof Resource)) {
            $uri = $uri->getUri();
        } elseif (!is_string($uri)) {
            throw new \InvalidArgumentException(
                '$uri should be a string or EasyRdf\Resource'
            );
        }

        foreach (self::namespaces() as $prefix => $long) {
            if (substr($uri, 0, strlen($long)) !== $long) {
                continue;
            }

            $local_part = substr($uri, strlen($long));

            // check that local part only contains valid QName characters
            if (!self::isValidXMLUriPart($local_part)) {
                continue;
            }

            return array($prefix, $local_part);
        }

        if ($createNamespace) {
            // Try and create a new namespace
            # FIXME: check the valid characters for an XML element name
            if (preg_match('/^(.+?)([\w\-]+)$/', $uri, $matches)) {
                $prefix = "ns".(self::$anonymousNamespaceCount++);
                self::set($prefix, $matches[1]);
                return array($prefix, $matches[2]);
            }
        }

        return null;
    }

    /**
      * Return the prefix namespace that a URI belongs to.
      *
      * @param string $uri A full URI (eg 'http://xmlns.com/foaf/0.1/name')
     *
      * @return string The prefix namespace that it is a part of(eg 'foaf')
      */
    public static function prefixOfUri($uri)
    {
        if ($parts = self::splitUri($uri)) {
            return $parts[0];
        }
    }

    /**
      * Shorten a URI by substituting in the namespace prefix.
      *
      * If $createNamespace is true, and the URI isn't part of an existing
      * namespace, then EasyRdf will attempt to create a new namespace and
      * use that namespace to shorten the URI (for example ns0:term).
      *
      * If it isn't possible to shorten the URI, then null will be returned.
      *
      * @param string  $uri The full URI (eg 'http://xmlns.com/foaf/0.1/name')
      * @param bool    $createNamespace If true, a new namespace will be created
      *
      * @return string The shortened URI (eg 'foaf:name') or null
      */
    public static function shorten($uri, $createNamespace = false)
    {
        if ($parts = self::splitUri($uri, $createNamespace)) {
            return implode(':', $parts);
        }
    }

    /**
      * Expand a shortened URI (qname) back into a full URI.
      *
      * If it isn't possible to expand the qname, for example if the namespace
      * isn't registered, then the original string will be returned.
      *
      * @param string $shortUri The short URI (eg 'foaf:name')
      *
      * @throws \InvalidArgumentException
      * @return string The full URI (eg 'http://xmlns.com/foaf/0.1/name')
      */
    public static function expand($shortUri)
    {
        if (!is_string($shortUri) or $shortUri === '') {
            throw new \InvalidArgumentException(
                "\$shortUri should be a string and cannot be null or empty"
            );
        }

        if ($shortUri === 'a') {
            $namespaces = self::namespaces();
            return $namespaces['rdf'] . 'type';
        } elseif (preg_match('/^(\w+?):([\w\-]+)$/', $shortUri, $matches)) {
            $long = self::get($matches[1]);
            if ($long) {
                return $long . $matches[2];
            }
        } elseif (preg_match('/^(\w+)$/', $shortUri) and isset(self::$default)) {
            return self::$default . $shortUri;
        }

        return $shortUri;
    }

    /**
     * Check if a local or prefix portion of URI is valid XML
     * 
     * This check is based on the XML specification
     * 
     * prefix        ::= Name minus ":"                   // see: http://www.w3.org/TR/REC-xml-names/#NT-NCName
     * Name          ::= NameStartChar (NameChar)*        // see: http://www.w3.org/TR/REC-xml/#NT-Name
     * NameStartChar ::= ":" | [A-Z] | "_" | [a-z] | [#xC0-#xD6] | [#xD8-#xF6] | [#xF8-#x2FF] | [#x370-#x37D] |
     *                   [#x37F-#x1FFF] | [#x200C-#x200D] | [#x2070-#x218F] | [#x2C00-#x2FEF] |
     *                   [#x3001-#xD7FF] | [#xF900-#xFDCF] | [#xFDF0-#xFFFD] | [#x10000-#xEFFFF]
     * NameChar      ::= NameStartChar | "-" | "." | [0-9] | #xB7 | [#x0300-#x036F] | [#x203F-#x2040]
     *
     * @param string $uri
     * @return boolean
     */
    public static function isValidXMLUriPart(string $uri)
    {
        $_name_start_char = 
            'A-Z_a-z\x{C0}-\x{D6}\x{D8}-\x{F6}\x{F8}-\x{2FF}\x{370}-\x{37D}\x{37F}-\x{1FFF}' .
            '\x{200C}-\x{200D}\x{2070}-\x{218F}\x{2C00}-\x{2FEF}\x{3001}-\x{D7FF}\x{F900}-\x{FDCF}' . 
            '\x{FDF0}-\x{FFFD}\x{10000}-\x{EFFFF}';
        
        $_namechar = 
            $_name_start_char .
            '\-\.0-9\x{B7}\x{0300}-\x{036F}\x{203F}-\x{2040}';

        $regex = "/^[$_name_start_char][$_namechar]*\$/u";

        return (bool) preg_match($regex, $uri);
    }
}
