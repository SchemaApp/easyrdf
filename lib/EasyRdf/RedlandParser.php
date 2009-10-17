<?php

/**
 * EasyRdf
 *
 * LICENSE
 *
 * Copyright (c) 2009 Nicholas J Humfrey.  All rights reserved.
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
 * @copyright  Copyright (c) 2009 Nicholas J Humfrey
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @version    $Id: RedlandParser.php 178 2009-10-02 07:41:01Z njh@aelius.com $
 */

/**
 * @see EasyRdf_Exception
 */
require_once "EasyRdf/Exception.php";

/**
 * Class to allow parsing of RDF using Redland (librdf) C library.
 *
 * @package    EasyRdf
 * @copyright  Copyright (c) 2009 Nicholas J Humfrey
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
class EasyRdf_RedlandParser
{
    private $_world = null;

    /**
     *  Types supported by Redland:
     *
     *  ntriples: N-Triples
     *  turtle: Turtle Terse RDF Triple Language
     *  trig: TriG - Turtle with Named Graphs
     *  rss-tag-soup: RSS Tag Soup
     *  grddl: Gleaning Resource Descriptions from Dialects of Languages
     *  guess: Pick the parser to use using content type and URI
     *  rdfa: RDF/A via librdfa
     *  raptor: (null)
     *  rdfxml: RDF/XML
     */

    private static function node_type_string($node)
    {
        switch(librdf_node_get_type($node))
        {
            case 1:
                return 'uri';
                break;
            case 2:
                return 'literal';
                break;
            case 4:
                return 'bnode';
                break;
            default:
                return 'unknown';
                break;
        }
    }
    
    private static function node_uri_string($node)
    {
        $uri = librdf_node_get_uri($node);
        if (!$uri) {
            throw new EasyRdf_Exception("Failed to get URI of node");
        }
        $str = librdf_uri_to_string($uri);
        if (!$str) {
            throw new EasyRdf_Exception(
                "Failed to convert librdf_uri to string"
            );
        }
        return $str;
    }
    
    
    private static function rdf_php_object($node)
    {
        $object = array();
        $object['type'] = EasyRdf_RedlandParser::node_type_string($node);
        if ($object['type'] == 'uri') {
            $object['value'] = EasyRdf_RedlandParser::node_uri_string($node);
        } else if ($object['type'] == 'bnode') {
            $object['value'] = librdf_node_get_blank_identifier($node);
        } else if ($object['type'] == 'literal') {
            $object['value'] = librdf_node_get_literal_value($node);
            $lang = librdf_node_get_literal_value_language($node);
            if ($lang) {
                $object['lang'] = $lang;
            }
            $datatype = librdf_node_get_literal_value_datatype_uri($node);
            if ($datatype) {
                $object['datatype'] = librdf_uri_to_string($datatype);
            }
        } else {
            throw new EasyRdf_Exception("Unsupported type: ".$object['type']);
        }
        return $object;
    }


    /**
     * Constructor
     *
     * @return object EasyRdf_ArcParser
     */
    public function __construct()
    {
        $this->_world = librdf_php_get_world();
        if (!$this->_world) {
            throw new EasyRdf_Exception(
                "Failed to initialise librdf world."
            );
        }
    }


    /**
      * Parse an RDF document
      *
      * @param string $uri      the base URI of the data
      * @param string $data     the document data
      * @param string $docType  the format of the input data
      * @return array           the parsed data
      */
    public function parse($uri, $data, $docType)
    {
        if (!is_string($uri) or $uri == null or $uri == '') {
            throw new InvalidArgumentException(
                "\$uri should be a string and cannot be null or empty"
            );
        }

        if (!is_string($data) or $data == null or $data == '') {
            throw new InvalidArgumentException(
                "\$data should be a string and cannot be null or empty"
            );
        }

        if (!is_string($docType) or $docType == null or $docType == '') {
            throw new InvalidArgumentException(
                "\$docType should be a string and cannot be null or empty"
            );
        }
    
        $parser = librdf_new_parser($this->_world, $docType, null, null);
        if (!$parser) {
            throw new EasyRdf_Exception(
                "Failed to create librdf_parser of type: $docType"
            );
        }

        $rdfUri = librdf_new_uri($this->_world, $uri);
        if (!$rdfUri) {
            throw new EasyRdf_Exception(
                "Failed to create librdf_uri from: $uri"
            );
        }

        $stream = librdf_parser_parse_string_as_stream(
            $parser, $data, $rdfUri
        );
        if (!$stream) {
            throw new EasyRdf_Exception(
                "Failed to parse RDF stream for: $rdfUri"
            );
        }

        $rdfphp = array();
        while (!librdf_stream_next($stream)) {
            # FIXME: do some checks
            $statement = librdf_stream_get_object($stream);
            if ($statement) {
                $subject = EasyRdf_RedlandParser::node_uri_string(
                    librdf_statement_get_subject($statement)
                );
                $predicate = EasyRdf_RedlandParser::node_uri_string(
                    librdf_statement_get_predicate($statement)
                );
                $object = librdf_statement_get_object($statement);
                
                if (!isset($rdfphp[$subject])) {
                    $rdfphp[$subject] = array();
                }
            
                if (!isset($rdfphp[$subject][$predicate])) {
                    $rdfphp[$subject][$predicate] = array();
                }
                
                array_push(
                    $rdfphp[$subject][$predicate],
                    EasyRdf_RedlandParser::rdf_php_object($object)
                );
            }
        }
        
        librdf_free_uri($rdfUri);
        librdf_free_stream($stream);
        librdf_free_parser($parser);
        
        return $rdfphp;
    }
}